<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Magic;

use ju1ius\XdgMime\Parser\AST\MagicMatchNode;
use ju1ius\XdgMime\Parser\AST\MagicRegexNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Utils\Iter;
use ju1ius\XdgMime\Utils\Regex;

/**
 * @internal
 */
final class RegExpManipulator
{
    public function __construct(
        public readonly string $delimiter = '/',
    ) {
    }

    public function canCompile(MagicMatchNode $node): bool
    {
        return $node->wordSize <= 1;
    }

    public function finalize(string $pattern): string
    {
        $flags = 'Ss';
        return sprintf(
            '%s(?n)\A%s%s%s',
            $this->delimiter,
            $pattern,
            $this->delimiter,
            $flags,
        );
    }

    public function quote(string $value): string
    {
        return Regex::quote($value, $this->delimiter);
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
        $matchPattern = match ($node->mask) {
            '' => $this->quote($node->value),
            default => $this->patternForMask($node->value, $node->mask),
        };
        return sprintf('(%s%s)', $rangePattern, $matchPattern);
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

    private function patternForMask(string $value, string $mask): string
    {
        $pattern = '';
        for ($i = 0, $l = \strlen($value); $i < $l; $i++) {
            $pattern .= match ($mask[$i]) {
                // $char & 0xFF is always equal to $char, so we must match the actual value.
                "\xFF" => $this->quote($value[$i]),
                // $char & 0x00 is always equal to 0x00, so we must match any value.
                "\x00" => '.',
                default => $this->characterClassForMask(\ord($value[$i]), \ord($mask[$i])),
            };
        }
        return $pattern;
    }

    private function characterClassForMask(int $char, int $mask): string
    {
        // find all possible octets matching ($char & $mask)
        $bytes = array_filter(
            range(0x00, 0xFF),
            fn(int $byte) => ($byte & $mask) === ($char & $mask),
        );
        // group found octets in contiguous ranges
        $ranges = Iter::chunkWhile(
            $bytes,
            fn(int $byte, array $range) => end($range) === $byte - 1,
        );
        // convert to a PCRE character class
        $pattern = '[';
        foreach ($ranges as $range) {
            $start = $range[0];
            $end = end($range);
            $pattern .= match ($start === $end) {
                true => sprintf('\x%02X', $start),
                false => sprintf('\x%02X-\x%02X', $start, $end),
            };
        }
        $pattern .= ']';

        return $pattern;
    }
}
