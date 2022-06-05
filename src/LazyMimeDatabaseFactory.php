<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

class LazyMimeDatabaseFactory extends MimeDatabaseFactory
{
    public static function fromCustomPaths($aliases, $globs, $magics, $subclasses): MimeDatabase
    {
        return new LazyMimeDatabase(
            function(&$database, &$initializer) use ($aliases, $globs, $magics, $subclasses) {
                // Instantiate real MimeDatabase object
                $database = parent::fromCustomPaths($aliases, $globs, $magics, $subclasses);
                // turn off further lazy initialization
                $initializer = null;
            }
        );
    }
}
