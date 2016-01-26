<?php

namespace ju1ius\XDGMime\Aliases;

use ju1ius\XDGMime\MimeType;

/**
 * @author ju1ius
 */
class AliasesDatabaseBuilder
{
    public function build(array $files)
    {
        $aliases = [];
        foreach ($files as $filepath) {
            $aliases = array_merge($aliases,  $this->parseFile($filepath));
        }
        return new AliasesDatabase($aliases);
    }

    private function parseFile($path)
    {
        $aliases = [];
        $lines = file($path, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

        if (!$lines) {
            return $aliases;
        }

        foreach ($lines as $line) {
            list($alias, $canonical) = explode(' ', $line, 2);
            $aliases[$alias] = MimeType::create($canonical);
        }

        return $aliases;
    }
}