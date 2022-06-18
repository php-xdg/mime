<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRegexNode;

/**
 * Matches that have a rangeLength >= 1 will be faster when compiled to a regular expression.
 */
final class ConvertRangedMatch extends MagicRuleOptimization
{
    public function __construct(
        private readonly RegExpManipulator $manipulator,
    ) {
    }

    public function preProcessMatch(MagicMatchNode $match): ?MagicMatchNode
    {
        if (!$this->isEligibleMatch($match)) {
            return null;
        }

        $pattern = $this->manipulator->patternFor($match);
        $node = new MagicRegexNode(
            $pattern,
            $this->manipulator->finalize($pattern),
            $match->getMaxLength(),
        );
        $node->children = $match->children;

        return $node;
    }

    private function isEligibleMatch(MagicMatchNode $node): bool
    {
        return (
            $this->manipulator->canCompile($node)
            && $node->rangeLength > 1
        );
    }
}
