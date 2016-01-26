<?php

namespace ju1ius\XDGMime\Globs;

use ju1ius\XDGMime\MimeType;

/**
 * @author ju1ius
 */
class GlobsDatabaseBuilder
{
    /**
     * @param array $files
     *
     * @return GlobsDatabase
     */
    public function build(array $files)
    {
        $allglobs = [];
        foreach ($files as $filepath) {
            $this->parseFile($filepath, $allglobs);
        }
        return $this->finalize($allglobs);
    }

    private function parseFile($filepath, &$allglobs)
    {
        $lines = file($filepath, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
        if (!$lines) {
            return $allglobs;
        }

        foreach ($lines as $line) {
            if ($line[0] === '#') {
                // Comment
                continue;
            }
            $fields = explode(':', $line);
            $weight = (int) $fields[0];
            $type = $fields[1];
            $pattern = $fields[2];

            if ($pattern === '__NOGLOBS__') {
                // This signals to discard any previous globs
                unset($allglobs[$type]);
                continue;
            }
            $flags = empty($fields[3]) ? [] : explode(',', $fields[3]);
            $mime = MimeType::create($type);
            $glob = new Glob($weight, $pattern, $mime, in_array('cs', $flags));

            $allglobs[$type][] = $glob;
        }
    }

    private function finalize($allglobs)
    {
        $globs = [];
        $extensions = [];
        $casedExtensions = [];
        $literals = [];
        $casedLiterals = [];

        foreach ($allglobs as $type => $typeGlobs) {
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
        usort($globs, function ($a, $b) {
            return $a->weight === $b->weight
                ? strlen($b->pattern) - strlen($a->pattern)
                : $b->weight - $a->weight;
        });

        return new GlobsDatabase($globs, $extensions, $casedExtensions, $literals, $casedLiterals);
    }
}