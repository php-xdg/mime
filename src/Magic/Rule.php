<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Magic;

/**
 * A Magic rule is a linked list of rules.
 *
 * @internal
 */
final class Rule extends AbstractRule
{
    public function __construct(
        public readonly int $depth,
        public readonly int $start,
        public readonly int $valueLength,
        public readonly string $value,
        public readonly string $mask,
        public readonly int $wordSize,
        public readonly int $range,
    ) {
    }

    public function matches(string $buffer, ?int $length = null): bool
    {
        $length ??= \strlen($buffer);

        if ($this->matchSingle($buffer, $length)) {
            if ($this->next) {
                return $this->next->matches($buffer, $length);
            }
            return true;
        }
        return false;
    }

    public function getMaxLength(): int
    {
        $length = $this->start + $this->valueLength + $this->range;
        if ($this->next) {
            return max($length, $this->next->getMaxLength());
        }

        return $length;
    }

    public function __toString(): string
    {
        $out = '';
        if ($this->depth) {
            $out .= $this->depth;
        }
        $out .= '>' . $this->start;
        $out .= '=' . pack('n', $this->valueLength) . $this->value;
        if ($this->mask) {
            $out .= '&' . $this->mask;
        }
        if ($this->wordSize) {
            $out .= '~' . $this->wordSize;
        }
        if ($this->range) {
            $out .= '+' . $this->range;
        }
        return $out;
    }

    private function matchSingle(string $buffer, int $length): bool
    {
        for ($offset = 0; $offset < $this->range; $offset++) {
            $start = $this->start + $offset;
            $end = $start + $this->valueLength;
            if ($length < $end) {
                return false;
            }
            if ($this->mask) {
                $test = '';
                for ($i = 0; $i < $this->valueLength; $i++) {
                    //$test .= \chr(\ord($buffer[$start + $i]) & \ord($this->mask[$i]));
                    $test .= ($buffer[$start + $i]) & ($this->mask[$i]);
                }
                if ($test === $this->value) {
                    return true;
                }
            } else {
                if (substr_compare($buffer, $this->value, $start, $this->valueLength) === 0) {
                    return true;
                }
            }
        }

        return false;
    }
}
