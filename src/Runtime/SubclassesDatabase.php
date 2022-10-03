<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

use Xdg\Mime\MimeType;

/**
 * A mapping from MIME types to types they inherit from.
 *
 * @internal
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

    public function isSubclassOf(string $type, string $other): bool
    {
        foreach ($this->ancestorsOf($type, true) as $ancestor) {
            if ($ancestor === $other) {
                return true;
            }
        }
        return false;
    }

    public function ancestorsOf(string $type, bool $includeSelf = false): \Traversable
    {
        if ($includeSelf) {
            yield $type;
        }
        foreach ($this->subclasses[$type] ?? [] as $parent) {
            yield $parent;
            yield from $this->ancestorsOf($parent);
        }
    }
}
