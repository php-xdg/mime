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
        public int $priority,
        public string $path,
        public ?string $type = null,
        public bool $caseSensitive = false,
        public bool $executable = false,
        public bool $nonEmpty = false,
        public ?string $mimeType = null,
    ) {
    }
}
