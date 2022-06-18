<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Utils;

use ju1ius\XdgMime\Exception\IOError;

/**
 * Object-oriented interface for `stat()` and `lstat()`.
 *
 * @see https://www.php.net/manual/fr/function.stat.php
*
 * @internal
 */
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

    private function __construct(
        public readonly int $device,
        public readonly int $inode,
        public readonly int $mode,
        public readonly int $numLinks,
        public readonly int $userId,
        public readonly int $groupId,
        public readonly int $deviceType,
        public readonly int $size,
        public readonly int $atime,
        public readonly int $mtime,
        public readonly int $ctime,
        public readonly int $blockSize,
        public readonly int $numBlocks,
    ) {
    }

    public static function of(string $path, bool $followLinks = false): self
    {
        if ($stat = $followLinks ? @stat($path) : @lstat($path)) {
            $stat = array_filter($stat, \is_int(...), \ARRAY_FILTER_USE_KEY);
            return new self(...$stat);
        }
        throw new IOError(sprintf('Could not stat "%s"', $path));
    }

    public function getType(): int
    {
        return $this->mode & self::TYPE_MASK;
    }

    public function isFile(): bool
    {
        return ($this->mode & self::TYPE_MASK) === self::FILE;
    }

    public function isExecutable(): bool
    {
        return (bool)(($this->mode & self::MODE_MASK) & 0o111);
    }
}
