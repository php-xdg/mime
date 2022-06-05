<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Globs;

/**
 * The glob2 file is a simple list of lines containing weight, MIME type and pattern, separated by a colon.
 * The lines are ordered by glob weight. For example:
 * <code>
 * 55:text/x-diff:*.patch
 * 50:text/x-diff:*.diff
 * </code>
 */
final class GlobsDatabase
{
    /**
     * @param Glob[] $globs
     * @param array<string, Glob> $extensions
     * @param array<string, Glob> $casedExtensions
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
     * If `$best` is `true`, return only the best match, or null if no matches were found.
     * If `$best` is `false` (default), return an array of matched globs.
     *
     * @return Glob|Glob[]|null
     */
    public function match(string $name, bool $best = false): Glob|array|null
    {
        $matches = [];
        // Literals
        $leaf = basename($name);
        if (isset($this->casedLiterals[$leaf])) {
            if ($best) {
                return $this->casedLiterals[$leaf];
            }
            $matches[] = $this->casedLiterals[$leaf];
        }
        // Case-insensitive literals
        $lowerLeaf = strtolower($leaf);
        if (isset($this->literals[$lowerLeaf])) {
            if ($best) {
                return $this->literals[$lowerLeaf];
            }
            $matches[] = $this->literals[$lowerLeaf];
        }
        // Extensions
        $ext = $leaf;
        while (true) {
            $p = strpos($ext, '.');
            if ($p === false) {
                break;
            }
            $ext = substr($ext, $p + 1);
            if (isset($this->casedExtensions[$ext])) {
                foreach ($this->casedExtensions[$ext] as $glob) {
                    if ($best) {
                        return $glob;
                    }
                    $matches[] = $glob;
                }
            }
        }
        // Case insensitive extensions
        $ext = $lowerLeaf;
        while (true) {
            $p = strpos($ext, '.');
            if ($p === false) {
                break;
            }
            $ext = substr($ext, $p + 1);
            if (isset($this->extensions[$ext])) {
                foreach ($this->extensions[$ext] as $glob) {
                    if ($best) {
                        return $glob;
                    }
                    $matches[] = $glob;
                }
            }
        }
        // Other globs
        foreach ($this->globs as $glob) {
            if ($glob->matches($leaf)) {
                if ($best) {
                    return $glob;
                }
                $matches[] = $glob;
            }
        }

        return $best ? null : $matches;
    }
}
