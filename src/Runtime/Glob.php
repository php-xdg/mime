<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

/**
 * @internal
 */
final class Glob extends GlobLiteral
{
    public function __construct(
        string $type,
        int $weight,
        public readonly string $pattern,
        public readonly bool $caseSensitive = false,
    ) {
        parent::__construct($type, $weight, \strlen($this->pattern));
    }

    public function matches(string $filename): bool
    {
        $flags = $this->caseSensitive ? 0 : \FNM_CASEFOLD;
        return fnmatch($this->pattern, $filename, $flags);
    }
}
