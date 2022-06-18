<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Compiler\Optimization\Magic\MagicRuleOptimization;
use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRuleNode;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

final class MagicRulesOptimizationPass implements OptimizationPassInterface
{
    /**
     * @param MagicRuleOptimization[] $optimizations
     */
    public function __construct(
        private readonly array $optimizations,
    ) {
    }

    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($info->magic as $i => $rule) {
            $info->magic[$i] = $this->processRule($rule);
        }

        return $info;
    }

    private function processRule($rule): MagicRuleNode
    {
        foreach ($this->optimizations as $optimization) {
            $rule = $optimization->preProcessRule($rule);
        }
        foreach ($rule->children as $i => $match) {
            $rule->children[$i] = $this->processMatch($match);
        }
        foreach ($this->optimizations as $optimization) {
            $rule = $optimization->postProcessRule($rule);
        }
        return $rule;
    }

    private function processMatch($match): MagicMatchNode
    {
        foreach ($this->optimizations as $optimization) {
            $match = $optimization->preProcessMatch($match);
        }
        foreach ($match->children as $i => $child) {
            $match->children[$i] = $this->processMatch($child);
        }
        foreach ($this->optimizations as $optimization) {
            $match = $optimization->postProcessMatch($match);
        }

        return $match;
    }
}
