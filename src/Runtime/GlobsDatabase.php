<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

/**
 * @internal
 */
final class GlobsDatabase
{
    /**
     * @param array<string, GlobLiteral[]> $extensions
     * @param array<string, GlobLiteral[]> $caseSensitiveExtensions
     * @param array<string, GlobLiteral> $literals
     * @param array<string, GlobLiteral> $caseSensitiveLiterals
     * @param Glob[] $globs
     */
    public function __construct(
        private readonly array $extensions,
        private readonly array $caseSensitiveExtensions,
        private readonly array $literals,
        private readonly array $caseSensitiveLiterals,
        private readonly array $globs,
    ) {
    }

    /**
     * Returns the matching glob(s) for the given filename.
     *
     * @return GlobLiteral[]
     */
    public function match(string $filename): array
    {
        $matches = [];
        // Literals
        $name = basename($filename);
        if ($match = $this->caseSensitiveLiterals[$name] ?? null) {
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
            if ($extensions = $this->caseSensitiveExtensions[$ext] ?? null) {
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

    private static function sort(GlobLiteral $a, GlobLiteral $b): int
    {
        return $b->weight <=> $a->weight ?: $b->length <=> $a->length;
    }
}
