<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
final class IconLookupPass implements OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($info->children as $type) {
            if ($icon = $type->icon) {
                $info->iconLookup[$type->name] = $icon;
            }
            if ($icon = $type->genericIcon) {
                $info->genericIconLookup[$type->name] = $icon;
            }
        }

        return $info;
    }
}
