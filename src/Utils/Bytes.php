<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Utils;

/**
 * @internal
 */
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

    /**
     * Implements the plain-text sniffing algorithm recommended by the spec.
     *
     * Checking the first 32 bytes of the file for ASCII control characters
     * is a good way to guess whether a file is binary or text,
     * but note that files with high-bit-set characters should still be treated as text
     * since these can appear in UTF-8 text, unlike control characters.
     */
    public static function looksLikePlainText(string $buffer): bool
    {
        return (bool)preg_match('/\A[^\x00-\x08\x0E-\x1F\x7F]+\z/Sx', substr($buffer, 0, 32));
    }
}
