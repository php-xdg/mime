<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Parser\AST;

/**
 * @internal
 */
final class RootXmlNode extends Node
{
    public function __construct(
        public readonly string $type,
        public readonly string $namespaceURI,
        public readonly string $localName,
    ) {
    }
}
