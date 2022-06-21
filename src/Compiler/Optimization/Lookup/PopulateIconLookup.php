<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Lookup;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Parser\AST\TypeNode;

/**
 * @internal
 */
final class PopulateIconLookup extends AbstractNodeVisitor
{
    private readonly MimeInfoNode $info;

    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $this->info = $node;
    }

    public function leaveNode(Node $node): Node
    {
        if ($node instanceof TypeNode) {
            if ($icon = $node->icon) {
                $this->info->iconLookup[$node->name] = $icon;
            }
            if ($icon = $node->genericIcon) {
                $this->info->genericIconLookup[$node->name] = $icon;
            }
        }

        return $node;
    }
}
