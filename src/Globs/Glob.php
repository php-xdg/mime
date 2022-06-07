<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Globs;

use ju1ius\XDGMime\MimeType;

/**
 * Internal data structure fo the Glob2 database.
 *
 * @internal
 */
final class Glob
{
    public readonly bool $isExtensionGlob;
    public readonly ?string $extension;
    public readonly bool $isLiteral;

    public function __construct(
        public readonly int $weight,
        public readonly string $pattern,
        public readonly string $type,
        public readonly bool $caseSensitive = false,
    ) {
        $this->isExtensionGlob = str_starts_with($pattern, '*.');
        if ($this->isExtensionGlob) {
            $pattern = substr($pattern, 2);
            $this->extension = $pattern;
        }
        $this->isLiteral = (bool)preg_match('/^[^\[*?]+$/', $pattern);
    }

    public function matches(string $name): bool
    {
        $flags = $this->caseSensitive ? 0 : \FNM_CASEFOLD;
        return fnmatch($this->pattern, $name, $flags);
    }
}
