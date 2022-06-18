<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\AST;

use Traversable;

/**
 * @template ChildType of Node
 * @internal
 */
abstract class CompositeNode extends Node
{
    /**
     * @var ChildType[]
     */
    public array $children = [];
}
