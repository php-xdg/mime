<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

use Exception;
use Traversable;

/**
 * @template ChildType of Node
 * @internal
 */
abstract class CompositeNode extends Node implements \IteratorAggregate
{
    /**
     * @var ChildType[]
     */
    public array $children = [];

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->children);
    }
}
