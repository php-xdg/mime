<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

use Xdg\Mime\MimeDatabaseInterface;

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
