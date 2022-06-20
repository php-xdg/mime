<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Parser\AST\Node;

/**
 * @internal
 */
interface NodeVisitorInterface
{
    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode;
    public function afterTraverse(MimeInfoNode $node): MimeInfoNode;

    public function enterNode(Node $node): Node;
    public function leaveNode(Node $node): Node;
}
