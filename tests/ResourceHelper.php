<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test;

final class ResourceHelper
{
    public static function getPath(string $path): string
    {
        return __DIR__ . '/Resources/' . $path;
    }

    public static function getFilePath(string $path): string
    {
        return self::getPath("files/{$path}");
    }
}
