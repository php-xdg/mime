<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Utils;

final class Regex
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
}
