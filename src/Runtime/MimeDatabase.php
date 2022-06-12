<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

use ju1ius\XDGMime\MimeType;
use ju1ius\XDGMime\Utils\Stat;

class MimeDatabase implements MimeDatabaseInterface
{
    public function __construct(
        protected AliasesDatabase $aliases,
        protected SubclassesDatabase $subclasses,
        protected GlobsDatabase $globs,
        protected MagicDatabaseInterface $magic,
    ) {
    }

    /**
     * Returns the canonical type of the given mime type.
     */
    public function getCanonicalType(MimeType $type): MimeType
    {
        return MimeType::of($this->aliases->canonical((string)$type));
    }

    /**
     * @return MimeType[]
     */
    public function getAncestors(MimeType $type): array
    {
        $ancestors = [];
        foreach ($this->subclasses->ancestorsOf((string)$type) as $ancestor) {
            $ancestors[] = MimeType::of($ancestor);
        }
        return array_unique($ancestors, \SORT_REGULAR);
    }

    public function guessTypeByFileName(string $path): MimeType
    {
        if ($globs = $this->globs->match($path)) {
            return MimeType::of($globs[0]->type);
        }

        return MimeType::unknown();
    }

    public function guessTypeByData(string $buffer): MimeType
    {
        if ($type = $this->magic->matchData($buffer)) {
            return MimeType::of($type);
        }
        return MimeType::unknown();
    }

    public function guessTypeByContents(string $path): MimeType
    {
        if ($type = $this->magic->match($path)) {
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
     * @param bool $followLinks whether to follow symlinks
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
         */
        if (!file_exists($path)) {
            return $this->guessTypeByFileName($path);
        }

        $stat = Stat::mode($path, $followLinks);
        if (!Stat::isFile($stat)) {
            // special filesystem objects
            return $this->guessTypeByStat($stat);
        }

        /**
         * Otherwise, start by doing a glob match of the filename.
         *
         * NOTE: while mentioned by the specs, the following steps are not implemented
         * by the xdg-mime reference library, and cause the shared-mime-info tests to fail.
         *
         * Keep only globs with the biggest weight.
         * If the patterns are different, keep only globs with the longest pattern.
         * If after this, there is one or more matching glob, and all the matching globs result in the same mimetype
         * use that mimetype as the result.
         */
        $globs = $this->globs->match($path);
        $hasConflictingGlobs = false;
        $possible = null;

        if ($globs) {
            if (\count($globs) === 1) {
                return MimeType::of($globs[0]->type);
            }
            // glob results are sorted by weight DESC, patternLength DESC
            $biggestWeight = $globs[0]->weight;
            $longestPattern = $globs[0]->length;
            for ($i = 1; $i < \count($globs); $i++) {
                $glob = $globs[$i];
                //if ($glob->weight < $biggestWeight) {
                //    break;
                //}
                //if ($glob->length < $longestPattern) {
                //    break;
                //}
                if ($glob->type !== $globs[0]->type) {
                    $hasConflictingGlobs = true;
                }
            }
            if (!$hasConflictingGlobs) {
                return MimeType::of($globs[0]->type);
            }
            //$globs = array_slice($globs, 0, $i);
            $possible = [];
            foreach ($globs as $glob) {
                foreach ($this->subclasses->ancestorsOf($glob->type, true) as $type) {
                    $possible[$type] = true;
                }
            }
        }
        /**
         * If the glob matching fails or results in multiple conflicting mimetypes,
         * read the contents of the file and do magic sniffing on it.
         *
         * If no magic rule matches the data (or if the content is not available),
         * use the default type of application/octet-stream for binary data, or text/plain for textual data.
         *
         * - Note: Checking the first 32 bytes of the file for ASCII control characters
         * is a good way to guess whether a file is binary or text,
         * but note that files with high-bit-set characters should still be treated as text
         * since these can appear in UTF-8 text, unlike control characters.
         */
        $sniffedType = $this->magic->match($path, $possible);
        if (!$sniffedType) {
            if (Stat::isExecutable($stat)) {
                $sniffedType = 'application/x-executable';
            } else {
                $sniffedType = 'application/octet-stream';
            }
        }
        /**
         * If there was no glob match, use the magic match as the result.
         */
        if (!$globs) {
            return MimeType::of($sniffedType);
        }
        /**
         * If any of the mimetypes resulting from a glob match is equal to or a subclass of
         * the result from the magic sniffing, use this as the result.
         *
         * This allows us for example to distinguish text files called "foo.doc"
         * from MS-Word files with the same name, as the magic match for the MS-Word file
         * would be application/x-ole-storage which the MS-Word type inherits.
         */
        foreach ($globs as $glob) {
            if ($this->subclasses->isSubclassOf($glob->type, $sniffedType)) {
                return MimeType::of($glob->type);
            }
        }
        /**
         * Otherwise use the result of the glob match that has the highest weight.
         */
        return MimeType::of($globs[0]->type);
    }

    private function guessTypeByStat(int $mode): MimeType
    {
        return match (Stat::type($mode)) {
            Stat::DIRECTORY => MimeType::directory(),
            Stat::SYMLINK => MimeType::symlink(),
            Stat::CHARACTER_DEVICE => MimeType::characterDevice(),
            Stat::BLOCK_DEVICE => MimeType::blockDevice(),
            Stat::FIFO => MimeType::fifo(),
            Stat::SOCKET => MimeType::socket(),
            default => MimeType::door(),
        };
    }
}