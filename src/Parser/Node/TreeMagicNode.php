<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

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
