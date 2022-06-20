<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Lookup;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Parser\AST\TypeNode;

/**
 * @internal
 */
final class AliasLookupVisitor extends AbstractNodeVisitor
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
