<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Aliases;

use ju1ius\XDGMime\MimeType;

class AliasesDatabaseBuilder
{
    /**
     * @param string[] $files
     */
    public function build(array $files): AliasesDatabase
    {
        $aliases = [];
        foreach ($files as $filepath) {
            $aliases = array_merge($aliases, $this->parseFile($filepath));
        }
        return new AliasesDatabase($aliases);
    }

    /**
     * @return array<string, MimeType>
     */
    private function parseFile(string $path): array
    {
        $lines = file($path, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
        if (!$lines) {
            return [];
        }

        $aliases = [];
        foreach ($lines as $line) {
            [$alias, $canonical] = explode(' ', $line, 2);
            $aliases[$alias] = $canonical;
        }

        return $aliases;
    }
}
