<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Subclasses;

use ju1ius\XDGMime\MimeType;

final class SubclassesDatabaseBuilder
{
    /**
     * @param string[] $files
     */
    public function build(array $files): SubclassesDatabase
    {
        $subclasses = [];
        foreach ($files as $path) {
            $lines = file($path, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
            if (!$lines) {
                continue;
            }
            foreach ($lines as $line) {
                [$subclass, $parent] = explode(' ', $line, 2);
                $subclasses[$subclass][$parent] = MimeType::of($parent);
            }
        }

        return new SubclassesDatabase($subclasses);
    }
}
