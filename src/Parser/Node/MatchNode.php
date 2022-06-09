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
        public int $priority,
        public string $type,
        string $offset,
        public string $value,
        public string $mask,
    ) {
        $range = explode(':', $offset);
        $this->start = $this->end = (int)$range[0];
        if (\count($range) > 1) {
            $this->end = (int)$range[1];
        }
    }

    public function getMaxLength(): int
    {
        $length = $this->end + \strlen($this->value);
        foreach ($this->and as $match) {
            $length = max($length, $match->getMaxLength());
        }
        return $length;
    }
}
