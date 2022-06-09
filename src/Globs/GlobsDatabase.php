<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Globs;

final class GlobsDatabase
{
    /**
     * @param Glob[] $globs
     * @param array<string, Glob[]> $extensions
     * @param array<string, Glob[]> $casedExtensions
     * @param array<string, Glob> $literals
     * @param array<string, Glob> $casedLiterals
     */
    public function __construct(
        private readonly array $globs,
        private readonly array $extensions,
        private readonly array $casedExtensions,
        private readonly array $literals,
        private readonly array $casedLiterals,
    ) {
    }

    /**
     * Returns the matching glob(s) for the given filename.
     *
     * @return Glob[]
     */
    public function match(string $filename): array
    {
        $matches = [];
        // Literals
        $name = basename($filename);
        if ($match = $this->casedLiterals[$name] ?? null) {
            $matches[] = $match;
        }
        // Case-insensitive literals
        $lowerName = strtolower($name);
        if ($match = $this->literals[$lowerName] ?? null) {
            $matches[] = $match;
        }
        // Extensions
        $ext = $name;
        while (true) {
            if (false === $p = strpos($ext, '.')) {
                break;
            }
            $ext = substr($ext, $p + 1);
            if ($extensions = $this->casedExtensions[$ext] ?? null) {
                array_push($matches, ...$extensions);
            }
        }
        // Case insensitive extensions
        $ext = $lowerName;
        while (true) {
            if (false === $p = strpos($ext, '.')) {
                break;
            }
            $ext = substr($ext, $p + 1);
            if ($extensions = $this->extensions[$ext] ?? null) {
                array_push($matches, ...$extensions);
            }
        }
        // Other globs
        foreach ($this->globs as $glob) {
            if ($glob->matches($name)) {
                $matches[] = $glob;
            }
        }

        usort($matches, self::sort(...));

        return $matches;
    }

    private static function sort(Glob $a, Glob $b): int
    {
        return $b->weight <=> $a->weight ?: $b->length <=> $a->length;
    }
}
