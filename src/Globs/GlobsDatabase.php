<?php

namespace ju1ius\XDGMime\Globs;

use ju1ius\XDGMime\Globs\Glob;
use ju1ius\XDGMime\MimeType;

/**
 * The glob2 file is a simple list of lines containing weight, MIME type and pattern, separated by a colon.
 * The lines are ordered by glob weight. For example:
 * <code>
 * 55:text/x-diff:*.patch
 * 50:text/x-diff:*.diff
 * </code>
 *
 * @author ju1ius
 */
class GlobsDatabase
{
    private $globs = [];
    private $extensions = [];
    private $casedExtensions = [];
    private $literals = [];
    private $casedLiterals = [];

    /**
     * GlobsDatabase constructor.
     *
     * @param array $globs
     * @param array $extensions
     * @param array $casedExtensions
     * @param array $literals
     * @param array $casedLiterals
     */
    public function __construct(
        array $globs,
        array $extensions,
        array $casedExtensions,
        array $literals,
        array $casedLiterals
    ) {
        $this->globs = $globs;
        $this->extensions = $extensions;
        $this->casedExtensions = $casedExtensions;
        $this->literals = $literals;
        $this->casedLiterals = $casedLiterals;
    }

    /**
     * Returns the matching glob(s) for the given filename.
     * If $best is true, return only the best match, or null if no matches were found.
     * If $best is false(default), return an array of matched globs.
     *
     * @param string $name
     *
     * @param bool   $best
     *
     * @return Glob|Glob[]|null
     */
    public function match($name, $best=false)
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
        // Case insensitive literals
        $lleaf = strtolower($leaf);
        if (isset($this->literals[$lleaf])) {
            if ($best) {
                return $this->literals[$lleaf];
            }
            $matches[] = $this->literals[$lleaf];
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
        $ext = $lleaf;
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
        /** @var Glob $glob */
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
