<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\AST;

/**
 * @extends CompositeNode<MatchNode>
 * @internal
 */
final class MatchNode extends CompositeNode
{
    public int $start;
    public int $end;
    /**
     * @var MatchNode[]
     */
    public array $children = [];

    public function __construct(
        public string $type,
        string $offset,
        public string $value,
        public string $mask,
        public int $wordSize,
    ) {
        $range = explode(':', $offset);
        $this->start = (int)$range[0];
        $this->end = $this->start + 1;
        if (\count($range) > 1) {
            $this->end = (int)$range[1];
        }
    }

    public function getMaxLength(): int
    {
        return array_reduce(
            $this->children,
            fn($length, $match) => max($length, $match->getMaxLength()),
            $this->end + \strlen($this->value),
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
