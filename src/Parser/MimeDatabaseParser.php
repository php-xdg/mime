<?php declare(strict_types=1);

namespace Xdg\Mime\Parser;

use Xdg\Mime\Parser\AST\GlobNode;
use Xdg\Mime\Parser\AST\MagicMatchNode;
use Xdg\Mime\Parser\AST\MagicRuleNode;
use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Parser\AST\RootXmlNode;
use Xdg\Mime\Parser\AST\TreeMagicNode;
use Xdg\Mime\Parser\AST\TreeMatchNode;
use Xdg\Mime\Parser\Exception\ParseError;
use Xdg\Mime\Parser\Validator\MimeInfoRngValidator;
use Xdg\Mime\Runtime\TreeMatchFlags;

/**
 * @internal
 */
final class MimeDatabaseParser
{
    private const FDO_NS = 'http://www.freedesktop.org/standards/shared-mime-info';

    private readonly MimeInfoValidatorInterface $validator;

    public function __construct()
    {
        $this->validator = new MimeInfoRngValidator();
    }

    public function parse(string ...$files): MimeInfoNode
    {
        $rootNode = new MimeInfoNode();
        foreach ($files as $file) {
            $this->parseFile($rootNode, $file);
        }
        return $rootNode;
    }

    public function parseXml(string ...$documents): MimeInfoNode
    {
        $rootNode = new MimeInfoNode();
        foreach ($documents as $xml) {
            $doc = new \DOMDocument();
            $doc->loadXML($xml);
            $this->parseDocument($rootNode, $doc);
        }
        return $rootNode;
    }

    private function parseFile(MimeInfoNode $root, string $file): void
    {
        $doc = new \DOMDocument();
        $doc->load($file, \LIBXML_PARSEHUGE|\LIBXML_COMPACT);
        $this->parseDocument($root, $doc);
    }

    private function parseDocument(MimeInfoNode $root, \DOMDocument $document): void
    {
        $this->validator->validate($document);
        $xpath = new \DOMXPath($document, true);
        $xpath->registerNamespace('fdo', self::FDO_NS);
        foreach ($xpath->query('//fdo:mime-type') as $node) {
            $this->parseMimeType($root, $node, $xpath);
        }
    }

    private function parseMimeType(MimeInfoNode $root, \DOMElement $node, \DOMXPath $xpath): void
    {
        $name = $node->getAttribute('type');
        $type = $root->createType($name);
        if ($xpath->evaluate('boolean(./fdo:glob-deleteall)', $node)) {
            $type->globs = [];
        }
        if ($xpath->query('boolean(./fdo:magic-deleteall)', $node)) {
            $type->magic = [];
        }
        if ($icon = $xpath->evaluate('string(./fdo:icon/@name)', $node)) {
            $type->icon = $icon;
        }
        if ($genericIcon = $xpath->evaluate('string(./fdo:generic-icon/@name)', $node)) {
            $type->genericIcon = $genericIcon;
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
            $magic = new MagicRuleNode(
                $name,
                $this->getIntegerAttribute($magicNode, 'priority', 50),
            );
            foreach ($xpath->query('./fdo:match', $magicNode) as $matchNode) {
                $magic->children[] = $this->parseMagicMatch($matchNode);
            }
            $type->magic[] = $magic;
        }
        foreach ($xpath->query('./fdo:treemagic', $node) as $magicNode) {
            $treeMagic = new TreeMagicNode(
                $name,
                $this->getIntegerAttribute($magicNode, 'priority', 50),
            );
            foreach ($xpath->query('./fdo:treematch', $magicNode) as $matchNode) {
                $treeMagic->children[] = $this->parseTreeMagicMatch($matchNode);
            }
            $type->treeMagic[] = $treeMagic;
        }
        foreach ($xpath->query('./fdo:root-XML', $node) as $rootXmlNode) {
            $type->rootXmlNodes[] = new RootXmlNode(
                $type->name,
                $rootXmlNode->getAttribute('namespaceURI'),
                $rootXmlNode->getAttribute('localName'),
            );
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

    private function parseMagicMatch(\DOMElement $node): MagicMatchNode
    {
        $type = $node->getAttribute('type');
        [$start, $length] = $this->parseRange($node->getAttribute('offset'));
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

        $match = new MagicMatchNode($type, $start, $length, $value, $mask ?? '', $wordSize);

        for ($child = $node->firstElementChild; $child; $child = $child->nextElementSibling) {
            $match->children[] = $this->parseMagicMatch($child);
        }

        return $match;
    }

    /**
     * @return array{int, int}
     */
    private function parseRange(string $offset): array
    {
        $range = explode(':', $offset);
        $start = (int)$range[0];
        $length = 1;
        if (\count($range) === 2) {
            $end = (int)$range[1];
            if ($end < $start) {
                throw new ParseError(sprintf(
                    'Invalid match offset "%s": end offset must greater than or equal to start offset.',
                    $offset,
                ));
            }
            $length = (int)$range[1] - $start + 1;
        }

        return [$start, $length];
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
            $match->children[] = $this->parseTreeMagicMatch($child);
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
            default => $this->parseIntMask($type, $value, $mask),
        };
    }

    /**
     * @return array{string, ?string}
     */
    private function parseStringMask(string $value, string $mask): array
    {
        $parsedValue = stripcslashes($value);
        if ($mask === '') {
            return [$parsedValue, null];
        }
        // mask is validated by the schema and is an hexadecimal string in the form 0xFF00
        $parsedMask = pack('H*', substr($mask, 2));
        if (\strlen($parsedMask) !== \strlen($parsedValue)) {
            throw new ParseError(sprintf(
                'Mask "%s" parsed length (%d) must equal value "%s" parsed length (%d)',
                $mask,
                \strlen($parsedMask),
                $value,
                \strlen($parsedValue),
            ));
        }
        return [$parsedValue, $parsedMask];
    }

    /**
     * @return array{string, ?string}
     */
    private function parseIntMask(string $type, string $value, string $mask): array
    {
        // host* numbers are stored in network byte-order and must be byte-swapped at runtime.
        $format = match ($type) {
            'byte' => 'C*',
            'host16', 'big16' => 'n*',
            'little16' => 'v*',
            'host32', 'big32' => 'N*',
            'little32' => 'V*',
        };

        $parsedValue = pack($format, $this->stringToInteger($value));
        if ($mask === '') {
            return [$parsedValue, null];
        }

        $parsedMask = pack($format, $this->stringToInteger($mask));

        return [$parsedValue, $parsedMask];
    }

    /**
     * Parses integers in hexadecimal (0x01, 0X01), octal (0777), or decimal notations.
     * It is equivalent to calling <code>strtoul(string, NULL, 0)</code> in C or C++
     */
    private function stringToInteger(string $value): int
    {
        // empty value is prevented by the schema validator
        return match ($value[0]) {
            '0' => match ($value[1] ?? null) {
                null => 0,
                'x', 'X' => hexdec($value),
                default => octdec($value),
            },
            default => (int)$value,
        };
    }
}
