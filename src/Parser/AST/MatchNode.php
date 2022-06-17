<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\AST;

/**
 * @extends CompositeNode<MatchNode>
 * @internal
 */
final class MatchNode extends CompositeNode
{
    /**
     * @var MatchNode[]
     */
    public array $children = [];

    public function __construct(
        public string $type,
        public int $rangeStart,
        public int $rangeLength,
        public string $value,
        public string $mask,
        public int $wordSize,
    ) {
    }

    public function getMaxLength(): int
    {
        return array_reduce(
            $this->children,
            fn($length, $match) => max($length, $match->getMaxLength()),
            $this->rangeStart + $this->rangeLength + \strlen($this->value),
        );
    }

    /**
     * Currently unused, but could be useful if we want to test the potential performance gains
     * of compiling MatchRules into regular expressions.
     *
     * @codeCoverageIgnore
     */
    public function isSimpleString(): bool
    {
        return (
            $this->type === 'string'
            && $this->mask === ''
            && array_reduce($this->children, fn($v, $m) => $v && $m->isSimpleString(), true)
        );
    }
}
