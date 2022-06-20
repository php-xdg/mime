<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRegexNode;
use ju1ius\XdgMime\Parser\AST\MagicRuleNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Utils\Iter;

/**
 * Merge consecutive children of a match to a single regular expression.
 * @internal
 */
final class CombineOrMatches extends AbstractNodeVisitor
{
    public function __construct(
        private readonly RegExpManipulator $manipulator,
    ) {
    }

    public function leaveNode(Node $node): Node
    {
        if ($node instanceof MagicRuleNode && $this->isEligibleRule($node)) {
            return $this->processNode($node);
        }
        if ($node instanceof MagicMatchNode && $this->isEligibleMatch($node)) {
            return $this->processNode($node);
        }

        return $node;
    }

    private function isEligibleRule(MagicRuleNode $rule): bool
    {
        return Iter::someConsecutive($rule->children, 2, $this->isEligibleChild(...));
    }

    private function isEligibleMatch(MagicMatchNode $match): bool
    {
        return $match->children
            && Iter::someConsecutive($match->children, 2, $this->isEligibleChild(...))
        ;
    }

    private function isEligibleChild(MagicMatchNode $child): bool
    {
        return (
            $this->manipulator->canCompile($child)
            && !$child->children
        );
    }

    private function processNode(MagicRuleNode|MagicMatchNode $node): MagicRuleNode|MagicMatchNode
    {
        $newChildren = [];
        $matches = [];
        foreach ($node->children as $child) {
            if ($this->isEligibleChild($child)) {
                $matches[] = $child;
            } else {
                if ($matches) {
                    $newChildren[] = $this->joinMatches($matches);
                }
                $matches = [];
                $newChildren[] = $child;
            }
        }
        if ($matches) {
            $newChildren[] = $this->joinMatches($matches);
        }
        $node->children = $newChildren;

        return $node;
    }

    /**
     * @param MagicMatchNode[] $matches
     */
    private function joinMatches(array $matches): MagicMatchNode
    {
        $patterns = [];
        $maxLength = 0;
        foreach ($matches as $match) {
            $patterns[] = $this->manipulator->patternFor($match);
            $maxLength = max($maxLength, $match->getMaxLength());
        }
        $pattern = $this->manipulator->or(...$patterns);

        return new MagicRegexNode($pattern, $this->manipulator->finalize($pattern), $maxLength);
    }
}
