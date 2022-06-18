<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

use ju1ius\XdgMime\Utils\Bytes;

/**
 * @internal
 */
final class MagicMatch implements MagicMatchInterface
{
    public readonly string $value;
    public readonly string $mask;

    /**
     * @param MagicMatchInterface[] $and
     */
    public function __construct(
        public readonly int $offset,
        public readonly int $rangeLength,
        string $value,
        string $mask = '',
        int $swap = 0,
        public readonly array $and = [],
    ) {
        /**
         * `$swap` will be either:
         *  - 0 if no byte-swapping is needed (we are on a big-endian platform)
         *  - $wordSize | 0x01 if byte-swapping is needed.
         * Therefore, we check if byte 0x01 is set, and unset it to get the actual wordSize.
         */
        $this->value = ($swap & 0b0001) ? Bytes::be2le($value, $swap & 0b1110) : $value;
        $this->mask = ($swap & 0b0001) ? Bytes::be2le($mask, $swap & 0b1110) : $mask;
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
        for ($offset = $this->offset, $l = $offset + $this->rangeLength; $offset < $l; $offset++) {
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
