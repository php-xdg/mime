<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Magic;

use finfo;

final class FileInfoMagicDatabase implements MagicDatabaseInterface
{
    private readonly finfo $fileInfo;

    public function __construct(?string $databasePath = null)
    {
        $this->fileInfo = new finfo(\FILEINFO_MIME_TYPE, $databasePath);
    }

    public function match(
        string $path,
        int $maxPriority = 100,
        int $minPriority = 0,
        ?array $possible = null,
    ): ?string {
        $type = $this->fileInfo->file($path);
        if ($possible && !\in_array($type, $possible, true)) {
            return null;
        }
        return $type;
    }

    public function matchData(
        string $data,
        int $maxPriority = 100,
        int $minPriority = 0,
        ?array $possible = null
    ): ?string {
        $type = $this->fileInfo->buffer($data);
        if ($possible && !\in_array($type, $possible, true)) {
            return null;
        }
        return $type;
    }
}
