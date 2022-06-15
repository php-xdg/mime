<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

/**
 * @internal
 */
final class TreeMatchNode
{
    /**
     * @var TreeMatchNode[]
     */
    public array $and = [];

    public function __construct(
        public string $path,
        public int $flags,
        public ?string $mimeType = null,
    ) {
    }
}
