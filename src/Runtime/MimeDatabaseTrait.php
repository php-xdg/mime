<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

use ju1ius\XdgMime\MimeType;
use ju1ius\XdgMime\Utils\Stat;
use Symfony\Component\Filesystem\Path;

// Help opcache.preload discover always-needed symbols.
// @codeCoverageIgnoreStart
class_exists(AliasesDatabase::class);
class_exists(GlobsDatabase::class);
class_exists(IconsDatabase::class);
class_exists(MagicDatabase::class);
class_exists(SubclassesDatabase::class);
class_exists(TreeMagicDatabase::class);
class_exists(XmlNamespacesDatabase::class);
// @codeCoverageIgnoreEnd

/**
 * @internal
 */
trait MimeDatabaseTrait
{
    private AliasesDatabase $aliases;
    private SubclassesDatabase $subclasses;
    private IconsDatabase $icons;
    private GlobsDatabase $globs;
    private MagicDatabase $magic;
    private TreeMagicDatabase $treeMagic;
    private XmlNamespacesDatabase $xmlNamespaces;

    public function getCanonicalType(MimeType $type): MimeType
    {
        return MimeType::of($this->aliases->canonical((string)$type));
    }

    public function getAncestors(MimeType $type): array
    {
        $canonical = $this->aliases->canonical((string)$type);
        $ancestors = [];
        foreach ($this->subclasses->ancestorsOf($canonical) as $ancestor) {
            $ancestors[] = MimeType::of($ancestor);
        }
        return array_unique($ancestors, \SORT_REGULAR);
    }

    public function getIconName(MimeType $type): string
    {
        return $this->icons->get((string)$type);
    }

    public function getGenericIconName(MimeType $type): string
    {
        return $this->icons->generic((string) $type, $type->media);
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

    public function guessType(string $path, bool $followLinks = true): MimeType
    {
        if (!is_readable($path)) {
            return $this->guessTypeByFileName($path);
        }

        /*
         * The RECOMMENDED order to perform the checks is:
         *
         * - If a MIME type is provided explicitly
         * (eg, by a ContentType HTTP header, a MIME email attachment, an extended attribute or some other means)
         * then that should be used instead of guessing.
         */
        $stat = Stat::of($path, $followLinks);
        if (!$stat->isFile()) {
            // special filesystem objects
            return $this->guessTypeByStat($stat);
        }

        /**
         * Otherwise, start by doing a glob match of the filename.
         *
         * NOTE: while mentioned by the specs, the two following steps are not implemented
         * by the xdg-mime reference library, and cause the shared-mime-info tests to fail:
         *   - Keep only globs with the biggest weight.
         *   - If the patterns are different, keep only globs with the longest pattern.
         *
         * If after this, there is one or more matching glob, and all the matching globs result in the same mimetype
         * use that mimetype as the result.
         */
        $globs = $this->globs->match($path);
        $allowedTypes = null;
        if ($globs) {
            if (\count($globs) === 1) {
                return MimeType::of($globs[0]->type);
            }
            $hasConflictingGlobs = false;
            for ($i = 1, $l = \count($globs); $i < $l; $i++) {
                if ($globs[$i]->type !== $globs[0]->type) {
                    $hasConflictingGlobs = true;
                    break;
                }
            }
            if (!$hasConflictingGlobs) {
                return MimeType::of($globs[0]->type);
            }
            $allowedTypes = [];
            foreach ($globs as $glob) {
                foreach ($this->subclasses->ancestorsOf($glob->type, true) as $type) {
                    $allowedTypes[$type] = true;
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
        $sniffedType = $this->magic->match($path, $allowedTypes);
        if (!$sniffedType) {
            if ($stat->isExecutable()) {
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

    public function guessTypeForTree(string $rootPath): MimeType
    {
        $rootPath = Path::canonicalize($rootPath);
        if (!is_dir($rootPath)) {
            return MimeType::unknown();
        }

        if ($matches = $this->treeMagic->match($rootPath, $this)) {
            // TODO: return array of types?
            return MimeType::of($matches[0]->type);
        }

        return MimeType::directory();
    }

    public function guessTypeForDomDocument(\DOMDocument $document): MimeType
    {
        if ($type = $this->xmlNamespaces->matchDomDocument($document)) {
            return MimeType::of($type);
        }
        return MimeType::of('application/xml');
    }

    public function guessTypeForXml(string $xml): MimeType
    {
        if ($type = $this->xmlNamespaces->matchData($xml)) {
            return MimeType::of($type);
        }
        return MimeType::of('application/xml');
    }

    private function guessTypeByStat(Stat $stat): MimeType
    {
        return match ($stat->getType()) {
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
