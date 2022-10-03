<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

/**
 * @internal
 */
final class AliasesDatabase
{
    public function __construct(
        private readonly array $aliases,
    ) {
    }

    public function canonical(string $type): string
    {
        return $this->aliases[$type] ?? $type;
    }
}
