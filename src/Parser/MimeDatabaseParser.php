<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser;

use ju1ius\XDGMime\Exception\ParseError;
use ju1ius\XDGMime\Parser\Node\GlobNode;
use ju1ius\XDGMime\Parser\Node\MatchNode;
use ju1ius\XDGMime\Parser\Node\TreeMatchNode;
use ju1ius\XDGMime\Parser\Node\TypeNode;

final class MimeDatabaseParser
{
    private array $types;

    public function parse(array $files): array
    {
        $this->types = [];
        foreach ($files as $file) {
            $this->parseFile($file);
        }
        return $this->types;
    }

    private function parseFile(string $file): void
    {
        $doc = new \DOMDocument();
        $doc->load($file, \LIBXML_PARSEHUGE|\LIBXML_COMPACT);
        $xpath = new \DOMXPath($doc, true);
        $xpath->registerNamespace('fd', $doc->documentElement->namespaceURI);
        foreach ($xpath->query('/fd:mime-info/fd:mime-type') as $node) {
            $this->parseMimeType($node, $xpath);
        }
    }

    private function parseMimeType(\DOMElement $node, \DOMXPath $xpath): void
    {
        $name = $node->getAttribute('type');
        $type = $this->types[$name] ??= new TypeNode($name);
        if ($xpath->query('./fd:glob-deleteall', $node)) {
            $type->globs = [];
        }
        if ($xpath->query('./fd:magic-deleteall', $node)) {
            $type->magic = [];
        }
        foreach ($xpath->query('./fd:alias', $node) as $aliasNode) {
            $type->aliases[] = $aliasNode->getAttribute('type');
        }
        foreach ($xpath->query('./fd:sub-class-of', $node) as $subClassNode) {
            $type->subclassOf[] = $subClassNode->getAttribute('type');
        }
        foreach ($xpath->query('./fd:glob', $node) as $globNode) {
            $type->globs[] = $this->parseGlob($globNode, $name);
        }
        foreach ($xpath->query('./fd:magic', $node) as $magicNode) {
            $priority = $this->getIntegerAttribute($magicNode, 'priority', 50);
            foreach ($xpath->query('./fd:match', $magicNode) as $matchNode) {
                try {
                    $type->magic[] = $this->parseMagicMatch($matchNode, $priority);
                } catch (ParseError) {
                    continue;
                }
            }
        }
        foreach ($xpath->query('./fd:treemagic', $node) as $magicNode) {
            $priority = $this->getIntegerAttribute($magicNode, 'priority', 50);
            foreach ($xpath->query('./fd:treematch', $magicNode) as $matchNode) {
                $type->treeMagic[] = $this->parseTreeMagicMatch($matchNode, $priority);
            }
        }
    }

    private function parseGlob(\DOMElement $node, string $mimeType): GlobNode
    {
        return new GlobNode(
            $mimeType,
            $this->getIntegerAttribute($node, 'weight', 50),
            $node->getAttribute('pattern'),
            $this->getBooleanAttribute($node, 'case-sensitive'),
        );
    }

    private function parseMagicMatch(\DOMElement $node, int $priority): MatchNode
    {
        $type = $node->getAttribute('type');
        $wordSize = match ($type) {
            'string', 'byte', 'big16', 'little16', 'big32', 'little32' => 1,
            'host16' => 2,
            'host32' => 4,
            '' => throw new ParseError('Missing <match> @type attribute.'),
            default => throw new ParseError(sprintf(
                'Unknown magic type: "%s"',
                $type,
            )),
        };
        [$value, $mask] = $this->parseMatchValue(
            $type,
            $node->getAttribute('value'),
            $node->getAttribute('mask'),
        );
        $match = new MatchNode(
            $priority,
            $type,
            $node->getAttribute('offset'),
            $value,
            $mask ?? '',
        );

        $child = $node->firstElementChild;
        while ($child) {
            if ($child->localName !== 'match') continue;
            $match->and[] = $this->parseMagicMatch($child, $priority);
            $child = $child->nextElementSibling;
        }

        return $match;
    }

    private function parseTreeMagicMatch(\DOMElement $node, int $priority): TreeMatchNode
    {
        $match = new TreeMatchNode(
            $priority,
            $node->getAttribute('path'),
            $node->getAttribute('type') ?: null,
            $this->getBooleanAttribute($node, 'match-case'),
            $this->getBooleanAttribute($node, 'executable'),
            $this->getBooleanAttribute($node, 'non_empty'),
            $node->getAttribute('mimetype') ?: null,
        );

        $child = $node->firstElementChild;
        while ($child) {
            if ($child->localName !== 'treematch') continue;
            $match->and[] = $this->parseTreeMagicMatch($child, $priority);
            $child = $child->nextElementSibling;
        }

        return $match;
    }

    private function getIntegerAttribute(\DOMElement $node, string $attribute, int $default): int
    {
        return match ($value = $node->getAttribute($attribute)) {
            '' => $default,
            default => (int)$value,
        };
    }

    private function getBooleanAttribute(\DOMElement $node, string $attribute, bool $default = false): bool
    {
        return match ($node->getAttribute($attribute)) {
            'true' => true,
            'false' => false,
            default => $default,
        };
    }

    /**
     * @return array{string, ?string}
     */
    private function parseMatchValue(string $type, string $value, string $mask): array
    {
        return match ($type) {
            'string' => $this->parseStringMask($value, $mask),
            'byte' => $this->parseIntMask($value, $mask, 1, false),
            'host16', 'big16' => $this->parseIntMask($value, $mask, 2, true),
            'little16' => $this->parseIntMask($value, $mask, 2, false),
            'host32', 'big32' => $this->parseIntMask($value, $mask, 4, true),
            'little32' => $this->parseIntMask($value, $mask, 4, false),
        };
    }

    /**
     * @return array{string, ?string}
     */
    private function parseStringMask(string $value, string $mask): array
    {
        $value = stripcslashes($value);
        if (!$mask) {
            return [$value, null];
        }
        if (!preg_match('/^0x([A-Fa-f\d]+)$/', $mask, $m)) {
            throw new ParseError(sprintf(
                'Invalid hexadecimal mask: %s',
                $mask,
            ));
        }
        $mask = $m[1];
        $length = \strlen($value);
        $parsedMask = array_fill(0, $length, 0);
        for ($i = 0; $i < \strlen($mask); $i++) {
            $char = hexdec($mask[$i]);
            if ($i >= $length * 2) {
                throw new ParseError(sprintf(
                    'Mask "%s" is longer than value "%s"',
                    $mask,
                    $value,
                ));
            }
            if ($i % 2) {
                $parsedMask[$i >> 1] |= $char;
            } else {
                $parsedMask[$i >> 1] |= $char << 4;
            }
        }
        return [
            $value,
            implode('', array_map(\chr(...), $parsedMask)),
        ];
    }

    /**
     * @return array{string, string}
     */
    private function parseIntMask(string $value, string $mask, int $bytes, bool $bigEndian): array
    {
        $value = (int)$value;
        if (
            ($bytes === 1 && ($value & ~0xFF))
            || ($bytes === 2 && ($value & ~0xFFFF))
        ) {
            throw new ParseError(sprintf(
                'Number value ot of range (%02X should fit in %d bytes).',
                $value,
                $bytes,
            ));
        }

        $parsedValue = '';
        for ($b = 0; $b < $bytes; $b++) {
            $shift = 8 * ($bigEndian ? ($bytes - $b - 1) : $b);
            $parsedValue .= chr(($value >> $shift) & 0xFF);
        }

        if ($mask === '') {
            return [$parsedValue, $mask];
        }

        $mask = (int)$mask;
        $parsedMask = '';
        for ($b = 0; $b < $bytes; $b++) {
            $shift = 8 * ($bigEndian ? ($bytes - $b - 1) : $b);
            $parsedMask .= \chr(($mask >> $shift) & 0xFF);
        }

        return [$parsedValue, $parsedMask];
    }

    private function escapeString(string $value): string
    {
        $output = '';
        for ($i = 0; $i < \strlen($value); $i++) {
            $c = $value[$i];
            $o = \ord($c);
            if ($o <= 0x1F || $o >= 0x7F) {
                $output .= match ($o) {
                    0x09 => '\t',
                    0x0A => '\n',
                    0x0B => '\v',
                    0x0C => '\f',
                    0x0D => '\r',
                    0x1B => '\e',
                    default => sprintf('\x%02X', $o),
                };
            } else {
                $output .= match ($c) {
                    '\\' => '\\\\',
                    '"' => '\"',
                    '$' => '\$',
                    default => $c,
                };
            }
        }
        return $output;
    }
}
