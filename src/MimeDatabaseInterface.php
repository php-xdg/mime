<?php declare(strict_types=1);

namespace ju1ius\XdgMime;

interface MimeDatabaseInterface
{
    /**
     * Returns the canonical type of the given mime type.
     */
    public function getCanonicalType(MimeType $type): MimeType;

    /**
     * Returns all the super-types of a given mime-type.
     *
     * @return MimeType[]
     */
    public function getAncestors(MimeType $type): array;

    public function getIconName(MimeType $type): string;

    public function getGenericIconName(MimeType $type): string;

    /**
     * Finds a file's MIME type using the XDG recommended checking order.
     *
     * This first checks the filename, then, if the name doesn't give an unambiguous MIME type,
     * uses the file contents if available.
     * It can also handle special filesystem objects like directories and sockets.
     *
     * @param string $path file path to examine (need not exist)
     * @param bool $followLinks whether to follow symlinks
     */
    public function guessType(string $path, bool $followLinks = true): MimeType;

    /**
     * Guesses a file's MIME type using the filename only (no I/O performed).
     */
    public function guessTypeByFileName(string $path): MimeType;

    /**
     * Guesses a file's MIME type using the file contents only (doesn't take the filename into account).
     */
    public function guessTypeByContents(string $path): MimeType;

    /**
     * Guesses the MIME type of a binary buffer.
     */
    public function guessTypeByData(string $buffer): MimeType;

    /**
     * Guesses the MIME type of a directory using XDG tree-magic rules.
     *
     * This can detect if the directory is something like a DVD, BluRay, executable CD-ROM, etc...
     */
    public function guessTypeForTree(string $rootPath): MimeType;
}
