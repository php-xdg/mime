<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

use ju1ius\XDGMime\MimeType;

class AliasesDatabase
{
    public function __construct(
        private readonly array $aliases,
    ) {
    }

    public function canonical(MimeType $alias): MimeType
    {
        return $this->get($alias, $alias);
    }

    /**
     * Get an alias, or the provided default if not found.
     */
    public function get(MimeType $alias, ?MimeType $default = null): ?MimeType
    {
        if ($type = $this->aliases[(string)$alias] ?? null) {
            return MimeType::of($type);
        }
        return $default;
    }
}
