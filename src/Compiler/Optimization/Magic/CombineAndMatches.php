<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler\Optimization\Magic;

use ju1ius\XDGMime\Parser\AST\MagicMatchNode;
use ju1ius\XDGMime\Parser\AST\MagicRegexNode;
use ju1ius\XDGMime\Utils\Iter;

final class CombineAndMatches extends MagicRuleOptimization
{
    public function __construct(
        private readonly RegExpManipulator $manipulator,
    ) {
    }

    public function postProcessMatch(MagicMatchNode $match): ?MagicMatchNode
    {
        if (!$this->isEligibleNode($match)) {
            return null;
        }
        $ifPattern = $this->manipulator->patternFor($match);
        $thenPatterns = [];
        $maxLength = $match->getMaxLength();
        foreach ($match->children as $child) {
            $thenPatterns[] = $this->manipulator->patternFor($child);
            $maxLength = max($maxLength, $child->getMaxLength());
        }
        $thenPattern = $this->manipulator->or(...$thenPatterns);
        $pattern = $this->manipulator->and($ifPattern, $thenPattern);

        return new MagicRegexNode($pattern, $this->manipulator->finalize($pattern), $maxLength);
    }

    private function isEligibleNode(MagicMatchNode $node): bool
    {
        return (
            $this->manipulator->canCompile($node)
            && $node->children
            && Iter::every($node->children, $this->isEligibleChild(...))
        );
    }

    private function isEligibleChild(MagicMatchNode $node): bool
    {
        return $this->manipulator->canCompile($node);
    }
}
