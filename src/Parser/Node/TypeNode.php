<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

/**
 * @internal
 */
final class TypeNode
{
    /**
     * @var string[]
     */
    public array $aliases = [];
    /**
     * @var string[]
     */
    public array $subclassOf = [];
    /**
     * @var GlobNode[]
     */
    public array $globs = [];

    public array $magic = [];
    public array $treeMagic = [];

    public function __construct(public readonly string $name)
    {
    }
}
