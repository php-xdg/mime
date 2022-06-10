<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

use ju1ius\XDGMime\MimeType;

/**
 * A mapping from MIME types to types they inherit from.
 */
final class SubclassesDatabase
{
    /**
     * @param array<string, MimeType[]> $subclasses
     */
    public function __construct(
        private readonly array $subclasses,
    ) {
    }

    /**
     * @return MimeType[]
     */
    public function getParents(MimeType $type): array
    {
        return array_map(MimeType::of(...), $this->subclasses[(string)$type] ?? []);
    }

    public function isSubclassOf(MimeType|string $type, MimeType|string $parent): bool
    {
        if ($type === $parent) {
            return true;
        }
        if ($parents = $this->subclasses[(string)$type] ?? null) {
            return \in_array((string)$parent, $parents, true);
        }
        return false;
    }
}
