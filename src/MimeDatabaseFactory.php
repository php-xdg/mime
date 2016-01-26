<?php

namespace ju1ius\XDGMime;

use ju1ius\XDGMime\Aliases\AliasesDatabaseBuilder;
use ju1ius\XDGMime\Globs\GlobsDatabaseBuilder;
use ju1ius\XDGMime\Magic\MagicDatabaseBuilder;
use ju1ius\XDGMime\Subclasses\SubclassesDatabaseBuilder;

/**
 * @author ju1ius
 */
class MimeDatabaseFactory
{
    private static $XDG_DATA_DIRS;

    public static function fromCustomPaths($aliases, $globs, $magics, $subclasses)
    {
        if (!is_array($aliases)) $aliases = [$aliases];
        if (!is_array($globs)) $globs = [$globs];
        if (!is_array($magics)) $magics = [$magics];
        if (!is_array($subclasses)) $magics = [$subclasses];

        $aliasBuilder = new AliasesDatabaseBuilder();
        $aliasDb = $aliasBuilder->build($aliases);

        $globsBuilder = new GlobsDatabaseBuilder();
        $globsDb = $globsBuilder->build($globs);

        $magicBuilder = new MagicDatabaseBuilder();
        $magicDb = $magicBuilder->build($magics);

        $subclassesBuilder = new SubclassesDatabaseBuilder();
        $subclassesDb = $subclassesBuilder->build($subclasses);

        return new MimeDatabase($aliasDb, $globsDb, $magicDb, $subclassesDb);
    }

    public static function fromXDGDirectories()
    {
        return static::fromCustomPaths(
            self::loadDataPaths("mime/aliases"),
            self::loadDataPaths("mime/globs2"),
            self::loadDataPaths("mime/magic"),
            self::loadDataPaths("mime/subclasses")
        );
    }

    public static function fromDefaults()
    {
        $db_path = __DIR__.'/Resources';
        return static::fromCustomPaths(
            $db_path.'/aliases',
            $db_path.'/globs2',
            $db_path.'/magic',
            $db_path.'/subclasses'
        );
    }

    private static function loadDataPaths($path)
    {
        $paths = [];
        foreach (self::getDataDirs() as $dir) {
            $p = "{$dir}/{$path}";
            if (file_exists($p)) $paths[] = $p;
        }

        return $paths;
    }

    private static function getDataDirs()
    {
        if (!is_array(self::$XDG_DATA_DIRS)) {
            $home = getenv('HOME');
            $data_home = getenv('XDG_DATA_HOME');
            if (!$data_home) {
                $data_home = "{$home}/.local/share";
            }
            $data_dirs = getenv('XDG_DATA_DIRS');
            if (!$data_dirs) {
                $data_dirs = "/usr/local/share:/usr/share";
            }

            self::$XDG_DATA_DIRS = array_merge([$data_home], explode(':', $data_dirs));
        }

        return self::$XDG_DATA_DIRS;
    }
}