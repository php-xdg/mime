<?php declare(strict_types=1);

namespace Xdg\Mime\Utils;

/**
 * @internal
 */
final class RegExp
{
    /**
     * Same as `preg_quote()`, but converts control characters to hexadecimal representation.
     *
     * {@see preg_quote https://github.com/php/php-src/blob/master/ext/pcre/php_pcre.c}
     */
    public static function quote(string $pattern, string $delimiter): string
    {
        $output = '';
        for ($i = 0, $l = \strlen($pattern); $i < $l; $i++) {
            $c = $pattern[$i];
            $o = \ord($c);
            $output .= match ($o <= 0x1F || $o >= 0x7F) {
                true => match ($c) {
                    "\t" => '\t',
                    "\n" => '\n',
                    "\v" => '\v',
                    "\f" => '\f',
                    "\r" => '\r',
                    default => sprintf('\x%02X', $o),
                },
                false => match ($c) {
                    '.', '\\', '+', '*', '?', '[', '^', ']', '$', '(', ')', '{', '}',
                    '=', '!', '>', '<', '|', ':', '-', '#', $delimiter => '\\' . $c,
                    default => $c,
                },
            };
        }
        return $output;
    }

    public static function byteSetToCharacterClass(int ...$bytes): string
    {
        // ensure bytes are unique and sorted
        sort($bytes);
        $bytes = array_unique($bytes);
        // group bytes in contiguous ranges
        $ranges = Iter::chunkWhile(
            $bytes,
            fn(int $byte, array $range) => end($range) === $byte - 1,
        );
        // convert to a PCRE character class
        $pattern = '';
        $format = fn(string $c) => ctype_alnum($c) ? $c : sprintf('\x%02X', \ord($c));
        foreach ($ranges as $range) {
            $start = \chr($range[0]);
            $end = \chr(end($range));
            $pattern .= match ($start === $end) {
                true => $format($start),
                false => sprintf('%s-%s', $format($start), $format($end)),
            };
        }

        return $pattern;
    }
}
