<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler\Optimization\Magic;

use ju1ius\XDGMime\Parser\AST\MagicMatchNode;
use ju1ius\XDGMime\Parser\AST\MagicRegexNode;
use ju1ius\XDGMime\Parser\AST\Node;
use ju1ius\XDGMime\Utils\Regex;

final class RegExpManipulator
{
    public function __construct(
        public readonly string $delimiter = '/',
    ) {
    }

    public function canCompile(MagicMatchNode $node): bool
    {
        return $node->mask === '' && $node->wordSize === 1;
    }

    public function finalize(string $pattern): string
    {
        return sprintf(
            '%1$s(?n)\A%2$s%1$sSs',
            $this->delimiter,
            $pattern,
        );
    }

    public function or(string ...$patterns): string
    {
        $pattern = implode('|', $patterns);
        return sprintf('(%s)', $pattern);
    }

    public function and(string $if, string $then): string
    {
        return sprintf('(?(?=%s)%s|(*FAIL))', $if, $then);
    }

    public function patternFor(Node $node): string
    {
        return match ($node::class) {
            MagicRegexNode::class => $node->pattern,
            MagicMatchNode::class => $this->patternForMagicMatch($node),
        };
    }

    private function patternForMagicMatch(MagicMatchNode $node): string
    {
        $rangePattern = $this->patternForRange($node);
        $matchPattern = Regex::quote($node->value, $this->delimiter);
        if ($rangePattern) {
            return sprintf(
                '(%s%s)',
                $rangePattern,
                $matchPattern,
            );
        }

        return sprintf('(%s)', $matchPattern);
    }

    private function patternForRange(MagicMatchNode $node): string
    {
        if ($node->rangeStart === 0 && $node->rangeLength <= 1) {
            return '';
        }
        $pattern = '';
        if ($node->rangeStart > 0) {
            $pattern = sprintf('.{%d}', $node->rangeStart);
        }
        if ($node->rangeLength > 1) {
            $pattern .= sprintf('.{0,%d}', $node->rangeLength - 1);
        }
        return $pattern;
    }
}
