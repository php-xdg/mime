<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Utils;

final class Bytes
{
    public static function swap(string $bytes, int $wordSize): string
    {
        return implode('', array_map(strrev(...), str_split($bytes, $wordSize)));
    }
}
