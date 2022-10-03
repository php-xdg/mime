<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

/**
 * @internal
 */
final class XmlNamespacesDatabase
{
    public function __construct(
        private readonly array $namespaces,
    ) {
    }

    public function get(string $namespace, string $localName): ?string
    {
        if ($ns = $this->namespaces[$namespace] ?? null) {
            if ($type = $ns[$localName] ?? $ns[''] ?? null) {
                return $type;
            }
        }

        return null;
    }

    public function matchData(string $data): ?string
    {
        if ($result = $this->scanXmlFragment($data)) {
            [$ns, $localName] = $result;
            return $this->get($ns, $localName);
        }

        return null;
    }

    public function matchDomDocument(\DOMDocument $document): ?string
    {
        $root = $document->documentElement;
        if ($root && $ns = $root->namespaceURI) {
            return $this->get($ns, $root->localName);
        }

        return null;
    }

    /**
     * @return array{string, string}|null
     */
    private function scanXmlFragment(string $data): ?array
    {
        $parser = xml_parser_create();
        xml_parser_set_option($parser, \XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, \XML_OPTION_SKIP_WHITE, 1);

        $result = null;
        $noop = static fn() => null;
        $handler = static function(\XMLParser $parser, string $localName, array $attributes) use (&$result, $noop) {
            if ($ns = $attributes['xmlns'] ?? null) {
                $result = [$ns, $localName];
            }
            xml_set_element_handler($parser, $noop, $noop);
        };
        xml_set_element_handler($parser, $handler, $noop);

        try {
            xml_parse($parser, $data);
        } finally {
            xml_parser_free($parser);
        }

        return $result;
    }
}
