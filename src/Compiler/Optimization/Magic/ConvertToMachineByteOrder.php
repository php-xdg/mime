<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Utils\Bytes;

/**
 * @internal
 */
final class ConvertToMachineByteOrder extends AbstractNodeVisitor
{
    public function __construct(
        private readonly bool $isLittleEndian,
    ) {
    }

    public function enterNode(Node $node): Node
    {
        if ($node instanceof MagicMatchNode && $node->wordSize > 1) {
            return $this->processMatch($node);
        }
        return $node;
    }

    private function processMatch(MagicMatchNode $node): MagicMatchNode
    {
        $clone = clone $node;

        if ($this->isLittleEndian) {
            $clone->value = Bytes::be2le($node->value, $node->wordSize);
            $clone->mask = Bytes::be2le($node->mask, $node->wordSize);
        }

        $clone->wordSize = 1;

        return $clone;
    }
}
