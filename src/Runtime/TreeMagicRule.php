<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

use ju1ius\XdgMime\MimeDatabaseInterface;

/**
 * @internal
 */
final class TreeMagicRule
{
    /**
     * @param TreeMagicMatch[] $matchlets
     */
    public function __construct(
        public readonly string $type,
        public readonly int $priority,
        private readonly array $matchlets,
    ) {
    }

    public function matches(string $rootPath, MimeDatabaseInterface $db): bool
    {
        foreach ($this->matchlets as $matchlet) {
            if ($matchlet->matches($rootPath, $db)) {
                return true;
            }
        }
        return false;
    }
}
