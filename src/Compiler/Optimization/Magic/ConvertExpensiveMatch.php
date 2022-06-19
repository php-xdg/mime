<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRegexNode;

/**
 * Matches will be faster when compiled to a regular expression when:
 *   - they have a rangeLength >= 1,
 *   - or they use a mask (and the mask can be compiled),
 * @internal
 */
final class ConvertExpensiveMatch extends MagicRuleOptimization
{
    const EXPENSIVE_RANGE_LENGTH = 2;
    const EXPENSIVE_MASK_LENGTH = 2;

    public function __construct(
        private readonly RegExpManipulator $manipulator,
    ) {
    }

    public function preProcessMatch(MagicMatchNode $match): MagicMatchNode
    {
        if (!$this->isEligibleMatch($match)) {
            return $match;
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
        return $this->manipulator->canCompile($node) && (
            $node->rangeLength >= self::EXPENSIVE_RANGE_LENGTH
            || \strlen($node->mask) >= self::EXPENSIVE_MASK_LENGTH
        );
    }
}
