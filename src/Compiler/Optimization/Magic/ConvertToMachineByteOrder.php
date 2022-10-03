<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Magic;

use Xdg\Mime\Compiler\Optimization\AbstractNodeVisitor;
use Xdg\Mime\Parser\AST\MagicMatchNode;
use Xdg\Mime\Parser\AST\Node;
use Xdg\Mime\Utils\Bytes;

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
