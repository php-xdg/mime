<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

final class TreeMagicNode
{
    /**
     * @var TreeMatchNode[]
     */
    public array $matches = [];

    public function __construct(
        public readonly string $type,
        public readonly int $priority,
    ) {
    }
}
