<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Lookup;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Parser\AST\TreeMagicNode;

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
