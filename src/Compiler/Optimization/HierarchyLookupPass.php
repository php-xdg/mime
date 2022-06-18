<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
final class HierarchyLookupPass implements OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($info->children as $type) {
            if ($type->subclassOf) {
                $info->hierarchyLookup[$type->name] = $type->subclassOf;
            }
        }
        return $info;
    }
}
