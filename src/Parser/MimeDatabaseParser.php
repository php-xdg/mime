<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser;

use ju1ius\XDGMime\Parser\Exception\ParseError;
use ju1ius\XDGMime\Parser\Node\GlobNode;
use ju1ius\XDGMime\Parser\Node\MagicNode;
use ju1ius\XDGMime\Parser\Node\MatchNode;
use ju1ius\XDGMime\Parser\Node\TreeMagicNode;
use ju1ius\XDGMime\Parser\Node\TreeMatchNode;
use ju1ius\XDGMime\Parser\Node\TypeNode;
use ju1ius\XDGMime\Parser\Validator\MimeInfoRngValidator;
use ju1ius\XDGMime\Runtime\TreeMatchFlags;

/**
 * @internal
 */
final class MimeDatabaseParser
{
    private const FDO_NS = 'http://www.freedesktop.org/standards/shared-mime-info';

    private readonly MimeInfoValidatorInterface $validator;

    /**
     * @var array<string, TypeNode>
     */
    private array $types;

    public function __construct()
    {
        $this->validator = new MimeInfoRngValidator();
    }

    /**
     * @return array<string, TypeNode>
     */
    public function parse(string ...$files): array
    {
        $this->types = [];
        foreach ($files as $file) {
            $this->parseFile($file);
        }
        return $this->types;
    }

    public function parseXml(string ...$documents): array
    {
        $this->types = [];
        foreach ($documents as $xml) {
            $doc = new \DOMDocument();
            $doc->loadXML($xml);
            $this->parseDocument($doc);
        }
        return $this->types;
    }

    private function parseFile(string $file): void
    {
        $doc = new \DOMDocument();
        $doc->load($file, \LIBXML_PARSEHUGE|\LIBXML_COMPACT);
        $this->parseDocument($doc);
    }

    private function parseDocument(\DOMDocument $document): void
    {
        $this->validator->validate($document);
        $name = $document->documentElement->localName;
        if ($name !== 'mime-info') {
            throw new ParseError(sprintf(
                'Unknown root element <%s>, expected <mime-info>',
                $name,
            ));
        }

        $xpath = new \DOMXPath($document, true);
        $xpath->registerNamespace('fdo', self::FDO_NS);
        foreach ($xpath->query('/fdo:mime-info/fdo:mime-type') as $node) {
            $this->parseMimeType($node, $xpath);
        }
    }

    private function parseMimeType(\DOMElement $node, \DOMXPath $xpath): void
    {
        $name = $node->getAttribute('type');
        $type = $this->types[$name] ??= new TypeNode($name);
        if ($xpath->query('./fdo:glob-deleteall', $node)) {
            $type->globs = [];
        }
        if ($xpath->query('./fdo:magic-deleteall', $node)) {
            $type->magic = [];
        }
        foreach ($xpath->query('./fdo:alias', $node) as $aliasNode) {
            $type->aliases[] = $aliasNode->getAttribute('type');
        }
        foreach ($xpath->query('./fdo:sub-class-of', $node) as $subClassNode) {
            $type->subclassOf[] = $subClassNode->getAttribute('type');
        }
        foreach ($xpath->query('./fdo:glob', $node) as $globNode) {
            $type->globs[] = $this->parseGlob($globNode, $name);
        }
        foreach ($xpath->query('./fdo:magic', $node) as $magicNode) {
            $magic = new MagicNode(
                $name,
                $this->getIntegerAttribute($magicNode, 'priority', 50),
            );
            foreach ($xpath->query('./fdo:match', $magicNode) as $matchNode) {
                $magic->matches[] = $this->parseMagicMatch($matchNode);
            }
            $type->magic[] = $magic;
        }
        foreach ($xpath->query('./fdo:treemagic', $node) as $magicNode) {
            $treeMagic = new TreeMagicNode(
                $name,
                $this->getIntegerAttribute($magicNode, 'priority', 50),
            );
            foreach ($xpath->query('./fdo:treematch', $magicNode) as $matchNode) {
                $treeMagic->matches[] = $this->parseTreeMagicMatch($matchNode);
            }
            $type->treeMagic[] = $treeMagic;
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

    private function parseMagicMatch(\DOMElement $node): MatchNode
    {
        $type = $node->getAttribute('type');
        $wordSize = match ($type) {
            'string', 'byte', 'big16', 'little16', 'big32', 'little32' => 1,
            'host16' => 2,
            'host32' => 4,
        };
        [$value, $mask] = $this->parseMatchValue(
            $type,
            $node->getAttribute('value'),
            $node->getAttribute('mask'),
        );
        $match = new MatchNode(
            $type,
            $node->getAttribute('offset'),
            $value,
            $mask ?? '',
            $wordSize,
        );

        for ($child = $node->firstElementChild; $child; $child = $child->nextElementSibling) {
            $match->and[] = $this->parseMagicMatch($child);
        }

        return $match;
    }

    private function parseTreeMagicMatch(\DOMElement $node): TreeMatchNode
    {
        $flags = 0;
        if ($this->getBooleanAttribute($node, 'match-case')) {
            $flags |= TreeMatchFlags::CASE_SENSITIVE;
        }
        if ($this->getBooleanAttribute($node, 'executable')) {
            $flags |= TreeMatchFlags::EXECUTABLE;
        }
        if ($this->getBooleanAttribute($node, 'non-empty')) {
            $flags |= TreeMatchFlags::NON_EMPTY;
        }
        $flags |= match ($node->getAttribute('type')) {
            'file' => TreeMatchFlags::TYPE_FILE,
            'directory' => TreeMatchFlags::TYPE_DIR,
            'link' => TreeMatchFlags::TYPE_LINK,
            default => TreeMatchFlags::TYPE_ANY,
        };
        $match = new TreeMatchNode(
            $node->getAttribute('path'),
            $flags,
            $node->getAttribute('mimetype') ?: null,
        );

        for ($child = $node->firstElementChild; $child; $child = $child->nextElementSibling) {
            $match->and[] = $this->parseTreeMagicMatch($child);
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
        $value = $this->stringToInteger($value);
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
            $parsedValue .= \chr(($value >> $shift) & 0xFF);
        }

        if ($mask === '') {
            return [$parsedValue, $mask];
        }

        $mask = $this->stringToInteger($mask);
        $parsedMask = '';
        for ($b = 0; $b < $bytes; $b++) {
            $shift = 8 * ($bigEndian ? ($bytes - $b - 1) : $b);
            $parsedMask .= \chr(($mask >> $shift) & 0xFF);
        }

        return [$parsedValue, $parsedMask];
    }

    /**
     * Parses integers in hexadecimal (0x01, 0X01), octal (0777), or decimal notations.
     */
    private function stringToInteger(string $value): int
    {
        return match ($value[0] ?? null) {
            '0' => match ($value[1] ?? null) {
                null => 0,
                'x', 'X' => hexdec($value),
                default => octdec($value),
            },
            null => throw new ParseError('Empty integer value.'),
            default => (int)$value,
        };
    }
}
