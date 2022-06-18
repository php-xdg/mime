<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler\Optimization\Magic;

use ju1ius\XDGMime\Parser\AST\MagicMatchNode;
use ju1ius\XDGMime\Parser\AST\MagicRegexMatchNode;

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
        $node = new MagicRegexMatchNode(
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
