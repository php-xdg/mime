<?php declare(strict_types=1);

namespace Xdg\Mime\Parser\AST;

/**
 * @extends CompositeNode<TreeMatchNode>
 * @internal
 */
final class TreeMagicNode extends CompositeNode
{
    public function __construct(
        public readonly string $type,
        public readonly int $priority,
    ) {
    }
}
