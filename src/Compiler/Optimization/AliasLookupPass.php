<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler\Optimization;

use ju1ius\XDGMime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
final class AliasLookupPass implements OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($info->children as $type) {
            foreach ($type->aliases as $alias) {
                $info->aliasLookup[$alias] = $type->name;
            }
        }

        return $info;
    }
}
