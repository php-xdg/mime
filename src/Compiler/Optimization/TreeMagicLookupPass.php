<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Parser\AST\TreeMagicNode;

final class TreeMagicLookupPass implements OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($info->children as $type) {
            foreach ($type->treeMagic as $rule) {
                $info->treeMagic[] = $rule;
            }
        }

        usort($info->treeMagic, self::compareNodes(...));

        return $info;
    }

    private static function compareNodes(TreeMagicNode $a, TreeMagicNode $b): int
    {
        return $b->priority <=> $a->priority ?: $a->type <=> $b->type;
    }
}
