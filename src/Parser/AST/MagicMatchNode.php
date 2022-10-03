<?php declare(strict_types=1);

namespace Xdg\Mime\Parser\AST;

/**
 * @extends CompositeNode<MagicMatchNode>
 * @internal
 */
class MagicMatchNode extends CompositeNode
{
    /**
     * @param MagicMatchNode[] $children
     */
    public function __construct(
        public string $type,
        public int $rangeStart,
        public int $rangeLength,
        public string $value,
        public string $mask,
        public int $wordSize,
        public array $children = [],
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
}
