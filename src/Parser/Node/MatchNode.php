<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

final class MatchNode
{
    public int $start;
    public int $end;
    /**
     * @var MatchNode[]
     */
    public array $and = [];

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
            $this->and,
            fn($length, $match) => max($length, $match->getMaxLength()),
            $this->end + \strlen($this->value),
        );
    }

    public function isSimpleString(): bool
    {
        return (
            $this->type === 'string'
            && $this->mask === ''
            && array_reduce($this->and, fn($v, $m) => $v && $m->isSimpleString(), true)
        );
    }
}
