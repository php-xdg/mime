<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Parser\AST\Node;

/**
 * @internal
 */
abstract class AbstractNodeVisitor implements NodeVisitorInterface
{
    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $node;
    }

    public function afterTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $node;
    }

    public function enterNode(Node $node): Node
    {
        return $node;
    }

    public function leaveNode(Node $node): Node
    {
        return $node;
    }
}
