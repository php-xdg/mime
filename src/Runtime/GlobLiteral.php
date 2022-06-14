<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

/**
 * @internal
 */
class GlobLiteral
{
    public function __construct(
        public readonly string $type,
        public readonly int $weight,
        public readonly int $length,
    ) {
    }
}
