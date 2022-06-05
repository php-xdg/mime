<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

use ju1ius\XDGMime\Aliases\AliasesDatabaseBuilder;
use ju1ius\XDGMime\Globs\GlobsDatabaseBuilder;
use ju1ius\XDGMime\Magic\MagicDatabaseBuilder;
use ju1ius\XDGMime\Subclasses\SubclassesDatabaseBuilder;
use ju1ius\XDGMime\Utils\XdgBaseDir;
use Symfony\Component\Filesystem\Path;

class MimeDatabaseFactory
{
    /**
     * @param string[] $aliases
     * @param string[] $globs
     * @param string[] $magics
     * @param string[] $subclasses
     *
     * @return MimeDatabase
     */
    public static function fromCustomPaths(
        array $aliases,
        array $globs,
        array $magics,
        array $subclasses,
    ): MimeDatabase {
        return new MimeDatabase(
            (new AliasesDatabaseBuilder())->build($aliases),
            (new GlobsDatabaseBuilder())->build($globs),
            (new MagicDatabaseBuilder())->build($magics),
            (new SubclassesDatabaseBuilder())->build($subclasses),
        );
    }

    public static function fromXDGDirectories(): MimeDatabase
    {
        return static::fromCustomPaths(
            self::loadDataPaths('mime/aliases'),
            self::loadDataPaths('mime/globs2'),
            self::loadDataPaths('mime/magic'),
            self::loadDataPaths('mime/subclasses'),
        );
    }

    public static function fromDefaults(): MimeDatabase
    {
        $dbPath = __DIR__ . '/Resources';
        return static::fromCustomPaths(
            [$dbPath . '/aliases'],
            [$dbPath . '/globs2'],
            [$dbPath . '/magic'],
            [$dbPath . '/subclasses'],
        );
    }

    private static function loadDataPaths(string $path): array
    {
        return iterator_to_array(XdgBaseDir::dataPaths($path));
    }
}
