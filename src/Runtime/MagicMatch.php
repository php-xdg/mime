<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

final class MagicMatch
{
    /**
     * @param self[] $and
     */
    public function __construct(
        public readonly int $start,
        public readonly int $end,
        public readonly string $value,
        public readonly string $mask = '',
        public readonly int $wordSize = 1,
        public readonly array $and = [],
    ) {
    }

    public function matches(string $buffer, int $length): bool
    {
        if (!$this->doMatch($buffer, $length)) {
            return false;
        }
        if (!$this->and) {
            return true;
        }
        foreach ($this->and as $matchlet) {
            if ($matchlet->matches($buffer, $length)) {
                return true;
            }
        }
        return false;
    }

    private function doMatch(string $buffer, int $length): bool
    {
        for ($offset = $this->start; $offset < $this->end; $offset++) {
            $end = $offset + \strlen($this->value);
            if ($length < $end) {
                return false;
            }
            if ($this->mask === '') {
                if (substr_compare($buffer, $this->value, $offset, \strlen($this->value)) === 0) {
                    return true;
                }
            } else {
                for ($i = 0; $i < \strlen($this->value); $i++) {
                    //$c = \chr(\ord($buffer[$start + $i]) & \ord($this->mask[$i]));
                    $c = ($buffer[$offset + $i]) & ($this->mask[$i]);
                    $v = ($this->value[$i]) & ($this->mask[$i]);
                    if ($c !== $v) {
                        continue 2;
                    }
                }
                return true;
            }
        }

        return false;
    }
}
