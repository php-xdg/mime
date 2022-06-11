<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Utils;

final class Stat
{
    // STAT_IFREG
    public const FILE = 0o100000;
    // STAT_IFDIR
    public const DIRECTORY = 0o040000;
    // STAT_IFCHR
    public const CHARACTER_DEVICE = 0o020000;
    // STAT_IFBLK
    public const BLOCK_DEVICE = 0o060000;
    // STAT_IFIFO
    public const FIFO = 0o010000;
    // STAT_IFLNK
    public const SYMLINK = 0o120000;
    // STAT_IFSOCK
    public const SOCKET = 0o140000;

    // STAT_IMODE
    private const MODE_MASK = 0o7777;
    // STAT_IFMT
    private const TYPE_MASK = 0o170000;

    public static function mode(string $path, bool $followLinks = false): int
    {
        $stat = $followLinks ? stat($path) : lstat($path);
        return $stat['mode'];
    }

    public static function type(int $mode): int
    {
        return $mode & self::TYPE_MASK;
    }

    public static function isFile(int $mode): bool
    {
        return ($mode & self::TYPE_MASK) === self::FILE;
    }

    public static function isExecutable(int $mode): bool
    {
        return (bool)(($mode & self::MODE_MASK) & 0o111);
    }
}
