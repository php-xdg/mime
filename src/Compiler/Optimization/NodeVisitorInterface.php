<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization;

use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Parser\AST\Node;

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
