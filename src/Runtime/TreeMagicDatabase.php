<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

use Xdg\Mime\MimeDatabaseInterface;

/**
 * @internal
 */
final class TreeMagicDatabase
{
    /**
     * @param TreeMagicRule[] $rules
     */
    public function __construct(
        private readonly array $rules,
    ) {
    }

    /**
     * @return TreeMagicRule[]
     */
    public function match(string $rootPath, MimeDatabaseInterface $db): array
    {
        $matches = [];
        foreach ($this->rules as $rule) {
            if ($rule->matches($rootPath, $db)) {
                $matches[] = $rule;
            }
        }

        return $matches;
    }
}
