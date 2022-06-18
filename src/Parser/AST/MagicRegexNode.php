<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\AST;

final class MagicRegexNode
{
    public function __construct(
        public readonly string $type,
        public readonly int $priority,
        public readonly string $pattern,
    ) {
    }
}
