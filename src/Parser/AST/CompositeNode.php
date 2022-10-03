<?php declare(strict_types=1);

namespace Xdg\Mime\Parser\AST;

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
