<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

/**
 * @internal
 */
final class MagicNode
{
    /**
     * @var MatchNode[]
     */
    public array $matches = [];

    public function __construct(
        public readonly string $type,
        public readonly int $priority,
    ) {
    }

    public function getMaxLength(): int
    {
        return max(array_map(fn($m) => $m->getMaxLength(), $this->matches));
    }

    public function isSimpleStringMatch(): bool
    {
        return array_reduce($this->matches, fn($v, $m) => $v && $m->isSimpleString(), true);
    }
}
