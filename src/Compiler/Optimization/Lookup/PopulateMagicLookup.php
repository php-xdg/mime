<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Lookup;

use Xdg\Mime\Compiler\Optimization\AbstractNodeVisitor;
use Xdg\Mime\Parser\AST\MagicRuleNode;
use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Parser\AST\Node;

/**
 * @internal
 */
final class PopulateMagicLookup extends AbstractNodeVisitor
{
    private readonly MimeInfoNode $info;

    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $this->info = $node;
    }

    public function leaveNode(Node $node): Node
    {
        if ($node instanceof MagicRuleNode) {
            $this->info->magic[] = $node;
        }

        return $node;
    }

    public function afterTraverse(MimeInfoNode $node): MimeInfoNode
    {
        usort($node->magic, self::compareNodes(...));
        return $node;
    }

    private static function compareNodes(MagicRuleNode $a, MagicRuleNode $b): int
    {
        return $b->priority <=> $a->priority ?: $a->type <=> $b->type;
    }
}
