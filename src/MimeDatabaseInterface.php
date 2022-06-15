<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

interface MimeDatabaseInterface
{
    /**
     * Returns the canonical type of the given mime type.
     */
    public function getCanonicalType(MimeType $type): MimeType;

    /**
     * @return MimeType[]
     */
    public function getAncestors(MimeType $type): array;

    /**
     * Finds a file's MIME type using the XDG recommended checking order.
     *
     * This first checks the filename, then uses file contents
     * if the name doesn't give an unambiguous MIME type.
     * It can also handle special filesystem objects like directories and sockets.
     *
     * @param string $path file path to examine (need not exist)
     * @param bool $followLinks whether to follow symlinks
     */
    public function guessType(string $path, bool $followLinks = true): MimeType;

    public function guessTypeByFileName(string $path): MimeType;

    public function guessTypeByData(string $buffer): MimeType;

    public function guessTypeByContents(string $path): MimeType;

    public function guessTypeForTree(string $rootPath): MimeType;
}
