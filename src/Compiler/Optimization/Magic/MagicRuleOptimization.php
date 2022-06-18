<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRuleNode;

abstract class MagicRuleOptimization
{
    public function preProcessRule(MagicRuleNode $rule): ?MagicRuleNode
    {
        return null;
    }

    public function postProcessRule(MagicRuleNode $rule): ?MagicRuleNode
    {
        return null;
    }

    public function preProcessMatch(MagicMatchNode $match): ?MagicMatchNode
    {
        return null;
    }

    public function postProcessMatch(MagicMatchNode $match): ?MagicMatchNode
    {
        return null;
    }
}
