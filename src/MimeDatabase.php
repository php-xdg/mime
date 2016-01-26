<?php

namespace ju1ius\XDGMime;

use ju1ius\XDGMime\Aliases\AliasesDatabase;
use ju1ius\XDGMime\Globs\Glob;
use ju1ius\XDGMime\Globs\GlobsDatabase;
use ju1ius\XDGMime\Magic\MagicDatabase;
use ju1ius\XDGMime\Subclasses\SubclassesDatabase;

/**
 * @author ju1ius
 */
class MimeDatabase
{
    const STAT_IFREG = 0100000;
    const STAT_IFDIR = 0040000;
    const STAT_IFCHR = 0020000;
    const STAT_IFBLK = 0060000;
    const STAT_IFIFO = 0010000;
    const STAT_IFLNK = 0120000;
    const STAT_IFSOCK = 0140000;

    const STAT_IMODE = 07777;
    const STAT_IFMT = 0170000;
    const STAT_IEXEC = 00100;

    /**
     * @var AliasesDatabase
     */
    private $aliasDb;

    /**
     * @var GlobsDatabase
     */
    private $globsDb;

    /**
     * @var MagicDatabase
     */
    private $magicDb;

    /**
     * @var SubclassesDatabase
     */
    private $subclassesDb;

    /**
     * MimeDatabase constructor.
     *
     * @param AliasesDatabase    $aliasDb
     * @param GlobsDatabase      $globsDb
     * @param MagicDatabase      $magicDb
     * @param SubclassesDatabase $subclassesDb
     */
    public function __construct(
        AliasesDatabase $aliasDb,
        GlobsDatabase $globsDb,
        MagicDatabase $magicDb,
        SubclassesDatabase $subclassesDb
    ) {
        $this->aliasDb = $aliasDb;
        $this->globsDb = $globsDb;
        $this->magicDb = $magicDb;
        $this->subclassesDb = $subclassesDb;
    }

    /**
     * Returns the canonical type of the given mime type.
     *
     * @param MimeType|string $type
     *
     * @return MimeType
     */
    public function getCanonicalType($type)
    {
        return $this->aliasDb->canonical(MimeType::create($type));
    }

    /**
     * @param MimeType|string $type
     *
     * @return MimeType[]
     */
    public function getParentTypes($type)
    {
        return $this->subclassesDb->getParents(MimeType::create($type));
    }

    /**
     * @param string $path
     *
     * @return MimeType|null
     */
    public function guessTypeByFileName($path)
    {
        $glob = $this->globsDb->match($path, true);

        return $glob ? $glob->type : MimeType::unknown();
    }

    /**
     * @param string $data
     * @param int    $maxPriority
     * @param int    $minPriority
     *
     * @return MimeType
     */
    public function guessTypeByData($data, $maxPriority = 100, $minPriority = 0)
    {
        return $this->magicDb->matchData($data, $maxPriority, $minPriority);
    }

    /**
     * @param string $path
     * @param int    $maxPriority
     * @param int    $minPriority
     *
     * @return MimeType
     */
    public function guessTypeByContents($path, $maxPriority = 100, $minPriority = 0)
    {
        return $this->magicDb->match($path, $maxPriority, $minPriority);
    }

    /**
     * Find the MIME type of a file using the XDG recommended checking order.
     *
     * This first checks the filename, then uses file contents
     * if the name doesn't give an unambiguous MIME type.
     * It can also handle special filesystem objects like directories and sockets.
     *
     * @param string $path        file path to examine (need not exist)
     * @param bool   $followLinks whether to follow symlinks
     *
     * @return MimeType
     */
    public function guessType($path, $followLinks = true)
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
        /** @var Glob[] $globs */
        $globs = $this->globsDb->match($path, false);
        usort($globs, function ($a, $b) {
            return $b->weight - $a->weight;
        });
        $possible = null;

        if ($globs) {
            $maxWeight = $globs[0]->weight;
            $i = 1;
            foreach (array_slice($globs, 1) as $glob) {
                if ($glob->weight < $maxWeight) {
                    break;
                }
                $i++;
            }
            $globs = array_slice($globs, 0, $i);
            if (count($globs) === 1) {
                return $globs[0]->type;
            }
            $possible = $globs;
        }

        $type = null;
        try {
            $type = $this->magicDb->match($path, 100, 0, $possible);
        } catch (\Exception $e) {}

        if ($type) {
            return MimeType::create($type);
        } elseif ($globs) {
            return $globs[0]->type;
        } elseif (($stat['mode'] & self::STAT_IMODE) & 0111) {
            return MimeType::defaultExecutable();
        } elseif ($this->looksLikeTextFile($path)) {
            return MimeType::defaultText();
        }

        return MimeType::unknown();
    }

    private function looksLikeTextFile($path)
    {
        $fp = fopen($path, 'rb');
        if ($fp === false) {
            return false;
        }

        $data = fread($fp, 32);
        fclose($fp);

        return preg_match('/[^\x00-\x08\x0E-\x1F\x7F]+/Sx', $data);
    }

    private function guessTypeByStat($mode)
    {
        switch ($mode & self::STAT_IFMT) {
            case self::STAT_IFDIR:
                return MimeType::directory();
            case self::STAT_IFLNK:
                return MimeType::symlink();
            case self::STAT_IFCHR:
                return MimeType::characterDevice();
            case self::STAT_IFBLK:
                return MimeType::blockDevice();
            case self::STAT_IFIFO:
                return MimeType::fifo();
            case self::STAT_IFSOCK:
                return MimeType::socket();
            default:
                return MimeType::door();
        }
    }
}