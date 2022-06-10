<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

use finfo;

final class FileInfoMagicDatabase implements MagicDatabaseInterface
{
    private finfo $fileInfo;

    public function __construct(
        private readonly ?string $databasePath = null,
    ) {
        $this->fileInfo = new finfo(\FILEINFO_MIME_TYPE, $this->databasePath);
    }

    public function match(string $path, ?array $allowedTypes = null): ?string
    {
        $type = $this->fileInfo->file($path);
        if ($allowedTypes && !\in_array($type, $allowedTypes, true)) {
            return null;
        }
        return $type;
    }

    public function matchData(string $data, ?array $allowedTypes = null): ?string
    {
        $type = $this->fileInfo->buffer($data);
        if ($allowedTypes && !\in_array($type, $allowedTypes, true)) {
            return null;
        }
        return $type;
    }

    public function __sleep(): array
    {
        return ['databasePath'];
    }

    public function __wakeup(): void
    {
        $this->fileInfo = new finfo(\FILEINFO_MIME_TYPE, $this->databasePath);
    }
}
