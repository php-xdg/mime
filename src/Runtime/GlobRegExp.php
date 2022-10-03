<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

/**
 * @internal
 */
final class GlobRegExp
{
    public function __construct(
        private readonly string $pattern,
        private readonly array $globs,
    ) {
    }

    /**
     * @return Glob[]
     */
    public function matches(string $filename): array
    {
        if (preg_match_all($this->pattern, $filename, $matches)) {
            return array_map(
                fn(string $mark) => $this->globs[$mark],
                $matches['MARK'],
            );
        }

        return [];
    }
}
