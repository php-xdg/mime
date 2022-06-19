<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\MagicRuleNode;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
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

    private static function compareNodes(MagicRuleNode $a, MagicRuleNode $b): int
    {
        return $b->priority <=> $a->priority ?: $a->type <=> $b->type;
    }
}
