<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Magic;

use Xdg\Mime\Compiler\Optimization\AbstractNodeVisitor;
use Xdg\Mime\Parser\AST\MagicMatchNode;
use Xdg\Mime\Parser\AST\MagicRegexNode;
use Xdg\Mime\Parser\AST\Node;

/**
 * Matches will be faster when compiled to a regular expression when:
 *   - they have a rangeLength >= 1,
 *   - or they use a mask (and the mask can be compiled),
 * @internal
 */
final class ConvertExpensiveMatch extends AbstractNodeVisitor
{
    private const EXPENSIVE_RANGE_LENGTH = 2;
    private const EXPENSIVE_MASK_LENGTH = 2;

    public function __construct(
        private readonly RegExpManipulator $manipulator,
    ) {
    }

    public function enterNode(Node $node): Node
    {
        if ($node instanceof MagicMatchNode && $this->isEligibleMatch($node)) {
            return new MagicRegexNode(
                $pattern = $this->manipulator->patternFor($node),
                $this->manipulator->finalize($pattern),
                $node->getMaxLength(),
                $node->children,
            );
        }

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
