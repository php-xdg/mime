<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Utils;

final class Bytes
{
    /**
     * @codeCoverageIgnore This is platform-dependent
     */
    public static function isLittleEndianPlatform(): bool
    {
        return unpack('S', "\x01\x00")[1] === 0x01;
    }

    /**
     * Converts a binary string of unsigned integers from big-endian to little-endian.
     *
     * `$wordSize` can be:
     *   - 2 for 16bit numbers
     *   - 4 for 32bit numbers
     */
    public static function be2le(string $bytes, int $wordSize): string
    {
        return match ($wordSize) {
            2 => pack('v*', ...unpack('n*', $bytes)),
            4 => pack('V*', ...unpack('N*', $bytes)),
        };
    }
}
