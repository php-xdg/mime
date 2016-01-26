<?php

namespace ju1ius\XDGMime;


/**
 * @author ju1ius
 */
class LazyMimeDatabaseFactory extends MimeDatabaseFactory
{
    public static function fromCustomPaths($aliases, $globs, $magics, $subclasses)
    {
        return new LazyMimeDatabase(
            function (&$database, &$initializer) use ($aliases, $globs, $magics, $subclasses) {
                // Instanciate real MimeDatabase object
                $database = parent::fromCustomPaths($aliases, $globs, $magics, $subclasses);
                // turn off further lazy initialization
                $initializer = null;
            }
        );
    }
}