<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

use ju1ius\XDGMime\Aliases\AliasesDatabase;
use ju1ius\XDGMime\Globs\Glob;
use ju1ius\XDGMime\Globs\GlobsDatabase;
use ju1ius\XDGMime\Magic\MagicDatabase;
use ju1ius\XDGMime\Subclasses\SubclassesDatabase;

class MimeDatabase
{
    private const STAT_IFREG = 0o100000;
    private const STAT_IFDIR = 0o040000;
    private const STAT_IFCHR = 0o020000;
    private const STAT_IFBLK = 0o060000;
    private const STAT_IFIFO = 0o010000;
    private const STAT_IFLNK = 0o120000;
    private const STAT_IFSOCK = 0o140000;

    private const STAT_IMODE = 0o7777;
    private const STAT_IFMT = 0o170000;
    private const STAT_IEXEC = 0o0100;

    public function __construct(
        private readonly AliasesDatabase $aliasDb,
        private readonly GlobsDatabase $globsDb,
        private readonly MagicDatabase $magicDb,
        private readonly SubclassesDatabase $subclassesDb,
    ) {
    }

    /**
     * Returns the canonical type of the given mime type.
     */
    public function getCanonicalType(MimeType|string $type): MimeType
    {
        return $this->aliasDb->canonical(MimeType::of($type));
    }

    /**
     * @return MimeType[]
     */
    public function getParentTypes(MimeType|string $type): array
    {
        return $this->subclassesDb->getParents(MimeType::of($type));
    }

    public function guessTypeByFileName(string $path): MimeType
    {
        $glob = $this->globsDb->match($path, true);

        return $glob ? MimeType::of($glob->type) : MimeType::unknown();
    }

    public function guessTypeByData(string $data, int $maxPriority = 100, int $minPriority = 0): MimeType
    {
        if ($type = $this->magicDb->matchData($data, $maxPriority, $minPriority)) {
            return MimeType::of($type);
        }
        return MimeType::unknown();
    }

    public function guessTypeByContents(string $path, int $maxPriority = 100, int $minPriority = 0): MimeType
    {
        if ($type = $this->magicDb->match($path, $maxPriority, $minPriority)) {
            return MimeType::of($type);
        }
        return MimeType::unknown();
    }

    /**
     * Find the MIME type of a file using the XDG recommended checking order.
     *
     * This first checks the filename, then uses file contents
     * if the name doesn't give an unambiguous MIME type.
     * It can also handle special filesystem objects like directories and sockets.
     *
     * @param string $path file path to examine (need not exist)
     * @param bool   $followLinks whether to follow symlinks
     *
     * @return MimeType
     */
    public function guessType(string $path, bool $followLinks = true): MimeType
    {
        /*
         * The RECOMMENDED order to perform the checks is:
         *
         * - If a MIME type is provided explicitly
         * (eg, by a ContentType HTTP header, a MIME email attachment, an extended attribute or some other means)
         * then that should be used instead of guessing.
         *
         * - Otherwise, start by doing a glob match of the filename.
         * If one or more glob matches, and all the matching globs result in the same mimetype,
         * use that mimetype as the result.
         *
         * - If the glob matching fails or results in multiple conflicting mimetypes,
         * read the contents of the file and do magic sniffing on it.
         * If no magic rule matches the data (or if the content is not available),
         * use the default type of application/octet-stream for binary data, or text/plain for textual data.
         * If there was no glob match, use the magic match as the result.
         *
         * - Note: Checking the first 32 bytes of the file for ASCII control characters
         * is a good way to guess whether a file is binary or text,
         * but note that files with high-bit-set characters should still be treated as text
         * since these can appear in UTF-8 text, unlike control characters.
         *
         * - If any of the mimetypes resulting from a glob match is equal to
         * or a subclass of the result from the magic sniffing, use this as the result.
         * This allows us for example to distinguish text files called "foo.doc"
         * from MS-Word files with the same name, as the magic match for the MS-Word file
         * would be application/x-ole-storage which the MS-Word type inherits.
         *
         * - Otherwise use the result of the glob match that has the highest weight.
         */
        if (!file_exists($path)) {
            return $this->guessTypeByFileName($path);
        }

        $stat = $followLinks ? stat($path) : lstat($path);
        if (($stat['mode'] & self::STAT_IFMT) !== self::STAT_IFREG) {
            // special filesystem objects
            return $this->guessTypeByStat($stat['mode']);
        }

        $globs = $this->globsDb->match($path, false);
        usort($globs, fn($a, $b) => $b->weight - $a->weight);
        $possible = null;

        if ($globs) {
            $maxWeight = $globs[0]->weight;
            $i = 1;
            foreach (\array_slice($globs, 1) as $glob) {
                if ($glob->weight < $maxWeight) {
                    break;
                }
                $i++;
            }
            $globs = \array_slice($globs, 0, $i);
            if (\count($globs) === 1) {
                return MimeType::of($globs[0]->type);
            }
            $possible = $globs;
        }

        $type = null;
        try {
            $type = $this->magicDb->match($path, 100, 0, $possible);
        } catch (\Exception $e) {
        }

        if ($type) {
            return MimeType::of($type);
        } elseif ($globs) {
            return MimeType::of($globs[0]->type);
        } elseif (($stat['mode'] & self::STAT_IMODE) & 0o111) {
            return MimeType::defaultExecutable();
        } elseif ($this->looksLikeTextFile($path)) {
            return MimeType::defaultText();
        }

        return MimeType::unknown();
    }

    private function looksLikeTextFile(string $path): bool
    {
        $fp = fopen($path, 'rb');
        if ($fp === false) {
            return false;
        }

        $data = fread($fp, 32);
        fclose($fp);

        return (bool)preg_match('/[^\x00-\x08\x0E-\x1F\x7F]+/Sx', $data);
    }

    private function guessTypeByStat(int $mode): MimeType
    {
        return match ($mode & self::STAT_IFMT) {
            self::STAT_IFDIR => MimeType::directory(),
            self::STAT_IFLNK => MimeType::symlink(),
            self::STAT_IFCHR => MimeType::characterDevice(),
            self::STAT_IFBLK => MimeType::blockDevice(),
            self::STAT_IFIFO => MimeType::fifo(),
            self::STAT_IFSOCK => MimeType::socket(),
            default => MimeType::door(),
        };
    }
}
