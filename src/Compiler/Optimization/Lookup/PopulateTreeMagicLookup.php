<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Lookup;

use Xdg\Mime\Compiler\Optimization\AbstractNodeVisitor;
use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Parser\AST\Node;
use Xdg\Mime\Parser\AST\TreeMagicNode;

/**
 * @internal
 */
final class PopulateTreeMagicLookup extends AbstractNodeVisitor
{
    private readonly MimeInfoNode $info;

    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $this->info = $node;
    }

    public function leaveNode(Node $node): Node
    {
        if ($node instanceof TreeMagicNode) {
            $this->info->treeMagic[] = $node;
        }

        return $node;
    }

    public function afterTraverse(MimeInfoNode $node): MimeInfoNode
    {
        usort($node->treeMagic, self::compareNodes(...));
        return $node;
    }

    private static function compareNodes(TreeMagicNode $a, TreeMagicNode $b): int
    {
        return $b->priority <=> $a->priority ?: $a->type <=> $b->type;
    }
}
