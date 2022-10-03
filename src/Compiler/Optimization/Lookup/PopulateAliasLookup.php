<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Lookup;

use Xdg\Mime\Compiler\Optimization\AbstractNodeVisitor;
use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Parser\AST\Node;
use Xdg\Mime\Parser\AST\TypeNode;

/**
 * @internal
 */
final class PopulateAliasLookup extends AbstractNodeVisitor
{
    private readonly MimeInfoNode $info;

    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $this->info = $node;
    }

    public function leaveNode(Node $node): Node
    {
        if ($node instanceof TypeNode) {
            foreach ($node->aliases as $alias) {
                $this->info->aliasLookup[$alias] = $node->name;
            }
        }

        return $node;
    }
}
