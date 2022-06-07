<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Globs;

use ju1ius\XDGMime\MimeType;

final class GlobsDatabaseBuilder
{
    /**
     * @param string[] $files
     */
    public function build(array $files): GlobsDatabase
    {
        $globs = [];
        foreach ($files as $filepath) {
            $this->parseFile($filepath, $globs);
        }
        return $this->finalize($globs);
    }

    private function parseFile(string $filepath, array &$allGlobs): void
    {
        $lines = file($filepath, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
        if (!$lines) {
            return;
        }

        foreach ($lines as $line) {
            if (str_starts_with($line, '#')) {
                // Comment
                continue;
            }
            $fields = explode(':', $line);
            $weight = (int)$fields[0];
            $type = $fields[1];
            $pattern = $fields[2];

            if ($pattern === '__NOGLOBS__') {
                // This signals to discard any previous globs
                unset($allGlobs[$type]);
                continue;
            }
            $flags = empty($fields[3]) ? [] : explode(',', $fields[3]);
            $glob = new Glob($weight, $pattern, $type, \in_array('cs', $flags));

            $allGlobs[$type][] = $glob;
        }
    }

    private function finalize(array $allGlobs): GlobsDatabase
    {
        $globs = [];
        $extensions = [];
        $casedExtensions = [];
        $literals = [];
        $casedLiterals = [];

        foreach ($allGlobs as $type => $typeGlobs) {
            /** @var Glob $glob */
            foreach ($typeGlobs as $glob) {
                // Literal extensions
                if ($glob->isExtensionGlob && $glob->isLiteral) {
                    if ($glob->caseSensitive) {
                        $casedExtensions[$glob->extension][] = $glob;
                    } else {
                        $extensions[strtolower($glob->extension)][] = $glob;
                    }
                    continue;
                }
                // Literal patterns
                if ($glob->isLiteral) {
                    if ($glob->caseSensitive) {
                        $casedLiterals[$glob->pattern] = $glob;
                    } else {
                        $literals[strtolower($glob->pattern)] = $glob;
                    }
                    continue;
                }
                // Globs
                $globs[] = $glob;
            }
        }
        // Sort globs by weight DESC & length DESC
        usort($globs, fn($a, $b) => (
            $a->weight === $b->weight
                ? \strlen($b->pattern) - \strlen($a->pattern)
                : $b->weight - $a->weight
        ));

        return new GlobsDatabase($globs, $extensions, $casedExtensions, $literals, $casedLiterals);
    }
}
