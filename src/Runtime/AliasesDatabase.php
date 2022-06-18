<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

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
