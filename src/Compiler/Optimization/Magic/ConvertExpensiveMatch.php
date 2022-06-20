<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRegexNode;
use ju1ius\XdgMime\Parser\AST\Node;

/**
 * Matches will be faster when compiled to a regular expression when:
 *   - they have a rangeLength >= 1,
 *   - or they use a mask (and the mask can be compiled),
 * @internal
 */
final class ConvertExpensiveMatch extends AbstractNodeVisitor
{
    const EXPENSIVE_RANGE_LENGTH = 2;
    const EXPENSIVE_MASK_LENGTH = 2;

    public function __construct(
        private readonly RegExpManipulator $manipulator,
    ) {
    }

    public function enterNode(Node $node): Node
    {
        if (!$node instanceof MagicMatchNode || !$this->isEligibleMatch($node)) {
            return $node;
        }

        return new MagicRegexNode(
            $pattern = $this->manipulator->patternFor($node),
            $this->manipulator->finalize($pattern),
            $node->getMaxLength(),
            $node->children,
        );
    }

    private function isEligibleMatch(MagicMatchNode $node): bool
    {
        return $this->manipulator->canCompile($node) && (
            $node->rangeLength >= self::EXPENSIVE_RANGE_LENGTH
            || \strlen($node->mask) >= self::EXPENSIVE_MASK_LENGTH
        );
    }
}
