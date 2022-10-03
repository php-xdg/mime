<?php declare(strict_types=1);

namespace Xdg\Mime\Tests;

final class ResourceHelper
{
    public static function getSharedMimeInfoPath(string $path): string
    {
        return \dirname(__DIR__) . '/resources/shared-mime-info/' . $path;
    }

    public static function getPath(string $path): string
    {
        return __DIR__ . '/Resources/' . $path;
    }

    public static function getFilePath(string $path): string
    {
        return self::getPath("files/{$path}");
    }

    public static function getTreePath(string $path): string
    {
        return self::getPath("trees/{$path}");
    }
}
