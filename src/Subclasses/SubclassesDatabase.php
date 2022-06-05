<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Subclasses;

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
        $type = (string)$type;
        if (!isset($this->subclasses[$type])) {
            return [];
        }

        return array_values($this->subclasses[$type]);
    }
}
