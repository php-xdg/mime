<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Lookup;

use Xdg\Mime\Compiler\Optimization\AbstractNodeVisitor;
use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Parser\AST\Node;
use Xdg\Mime\Parser\AST\RootXmlNode;

/**
 * @internal
 */
final class PopulateXmlNamespaceLookup extends AbstractNodeVisitor
{
    private readonly MimeInfoNode $info;

    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $this->info = $node;
    }

    public function leaveNode(Node $node): Node
    {
        if ($node instanceof RootXmlNode) {
            $this->info->xmlNamespaceLookup[$node->namespaceURI][$node->localName] = $node->type;
        }

        return $node;
    }
}
