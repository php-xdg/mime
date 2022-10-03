<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Magic;

use Xdg\Mime\Parser\AST\MagicMatchNode;
use Xdg\Mime\Parser\AST\MagicRegexNode;
use Xdg\Mime\Parser\AST\Node;
use Xdg\Mime\Utils\RegExp;

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
        return RegExp::quote($value, $this->delimiter);
    }

    public function or(string ...$patterns): string
    {
        if (\count($patterns) === 1) {
            return $patterns[0];
        }

        return sprintf('(%s)', implode('|', $patterns));
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
        return sprintf('%s%s', $rangePattern, $matchPattern);
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
        // convert to a PCRE character class
        return sprintf('[%s]', RegExp::byteSetToCharacterClass(...$bytes));
    }
}
