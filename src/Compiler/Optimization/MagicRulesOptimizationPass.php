<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Compiler\Optimization\Magic\MagicRuleOptimization;
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
            if ($result = $this->processRule($rule)) {
                $info->magic[$i] = $result;
            }
        }

        return $info;
    }

    private function processRule($rule): mixed
    {
        foreach ($this->optimizations as $optimization) {
            if ($result = $optimization->preProcessRule($rule)) {
                $rule = $result;
            }
        }
        foreach ($rule->children as $i => $match) {
            if ($result = $this->processMatch($match)) {
                $rule->children[$i] = $result;
            }
        }
        foreach ($this->optimizations as $optimization) {
            if ($result = $optimization->postProcessRule($rule)) {
                $rule = $result;
            }
        }
        return $rule;
    }

    private function processMatch($match): mixed
    {
        foreach ($this->optimizations as $optimization) {
            if ($result = $optimization->preProcessMatch($match)) {
                $match = $result;
            }
        }
        foreach ($match->children as $i => $child) {
            if ($result = $this->processMatch($child)) {
                $match->children[$i] = $result;
            }
        }
        foreach ($this->optimizations as $optimization) {
            if ($result = $optimization->postProcessMatch($match)) {
                $match = $result;
            }
        }

        return $match;
    }
}
