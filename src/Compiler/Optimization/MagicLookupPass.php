<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler\Optimization;

use ju1ius\XDGMime\Parser\Node\MagicNode;
use ju1ius\XDGMime\Parser\Node\MimeInfoNode;

final class MagicLookupPass implements OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($info->children as $type) {
            foreach ($type->magic as $rule) {
                $info->magic[] = $rule;
            }
        }

        usort($info->magic, self::compareNodes(...));

        return $info;
    }

    private static function compareNodes(MagicNode $a, MagicNode $b): int
    {
        return $b->priority <=> $a->priority ?: $a->type <=> $b->type;
    }
}
