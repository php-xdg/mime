<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

/**
 * @extends CompositeNode<MatchNode>
 * @internal
 */
final class MagicNode extends CompositeNode
{
    public function __construct(
        public readonly string $type,
        public readonly int $priority,
    ) {
    }

    public function getMaxLength(): int
    {
        return max(array_map(fn($m) => $m->getMaxLength(), $this->children));
    }

    /**
     * Currently unused, but could be useful if we want to test the potential performance gains
     * of compiling MatchRules into regular expressions.
     *
     * @codeCoverageIgnore
     */
    public function isSimpleStringMatch(): bool
    {
        return array_reduce($this->children, fn($v, $m) => $v && $m->isSimpleString(), true);
    }
}
