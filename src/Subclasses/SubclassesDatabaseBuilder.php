<?php

namespace ju1ius\XDGMime\Subclasses;

use ju1ius\XDGMime\MimeType;

/**
 * @author ju1ius
 */
class SubclassesDatabaseBuilder
{
    public function build(array $files)
    {
        $db = new SubclassesDatabase();
        foreach ($files as $path) {
            $lines = file($path, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
            if (!$lines) continue;
            foreach ($lines as $line) {
                list($subclass, $parent) = explode(' ', $line, 2);
                $db->add(MimeType::create($subclass), MimeType::create($parent));
            }
        }

        return $db;
    }
}