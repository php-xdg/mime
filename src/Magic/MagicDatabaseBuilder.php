<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Magic;

use ju1ius\XDGMime\Exception\DiscardMagicRules;
use ju1ius\XDGMime\Exception\ParseError;
use ju1ius\XDGMime\Exception\UnknownMagicRule;

final class MagicDatabaseBuilder
{
    private const RULE_END_RX = <<<'REGEXP'
    /
        (?: ~ (?<word_size> \d+ ) )?
        (?: \+ (?<range> \d+ ) )?
        \n
        $
    /Sx
    REGEXP;

    public function build(array $files): MagicDatabase
    {
        $rules = [];
        foreach ($files as $file) {
            $this->parseFile($file, $rules);
        }
        return $this->finalize($rules);
    }

    private function parseFile(string $filepath, array &$rules): void
    {
        $fp = fopen($filepath, 'rb');
        $line = fgets($fp);
        if ($line !== "MIME-Magic\0\n") {
            throw new ParseError('Invalid MIME Magic file');
        }
        while (true) {
            $heading = fgets($fp);
            if (!$heading) {
                break;
            }
            if (!str_starts_with($heading, '[') || !str_ends_with($heading, "]\n")) {
                throw new ParseError("Malformed magic section heading: {$heading}");
            }
            [$priority, $type] = explode(':', substr($heading, 1, -2), 2);
            $priority = (int)$priority;
            try {
                $rule = $this->parseCompositeRule($fp);
            } catch (DiscardMagicRules $err) {
                unset($rules[$type]);
                $rule = $this->parseCompositeRule($fp);
            }
            if (!$rule) {
                continue;
            }
            if (!isset($rules[$type])) {
                $rules[$type] = [];
            }
            $rules[$type][] = [$priority, $rule];
        }

        fclose($fp);
    }

    /**
     * @param resource $fp
     */
    private function parseCompositeRule($fp): CompositeRule|Rule|null
    {
        $char = fread($fp, 1);
        fseek($fp, -1, SEEK_CUR);
        $depthRules = [];

        while ($char && $char !== '[') {
            try {
                $rule = $this->parseRule($fp);
                $depthRules[] = $rule;
            } catch (UnknownMagicRule $e) {
                // Ignored to allow for extensions to the rule format.
            }
            $char = fread($fp, 1);
            if ($char) {
                fseek($fp, -1, SEEK_CUR);
            }
        }

        $tree = [];
        $insertPoints = [0 => &$tree];
        foreach ($depthRules as $rule) {
            $subRules = [];
            $insertPoints[$rule->depth][] = [$rule, $subRules];
            $insertPoints[$rule->depth + 1] = $subRules;
        }

        return $this->parseRuleTree($tree);
    }

    private function parseRuleTree(array $tree): CompositeRule|Rule|null
    {
        $rules = [];
        /**
         * @var Rule $rule
         * @var array $subRules
         */
        foreach ($tree as [$rule, $subRules]) {
            if (!empty($subRules)) {
                $rule->next = $this->parseRuleTree($subRules);
            }
            $rules[] = $rule;
        }
        $numRules = \count($rules);
        if ($numRules === 1) {
            return $rules[0];
        }
        if ($numRules > 1) {
            return new CompositeRule($rules);
        }
        return null;
    }

    /**
     * @param resource $fp
     *
     * @throws UnknownMagicRule
     * @throws DiscardMagicRules
     */
    private function parseRule($fp): Rule
    {
        $line = fgets($fp);

        // [indent] '>'
        [$nestDepth, $line] = explode('>', $line, 2);
        $nestDepth = $nestDepth ? (int) $nestDepth : 0;

        // start-offset '='
        [$startOffset, $line] = explode('=', $line, 2);
        $startOffset = (int) $startOffset;

        if ($line === "__NOMAGIC__\n") {
            throw new DiscardMagicRules();
        }
        // value length (2 bytes, big endian)
        //$valueLength = unpack('n', $line)[1]; // unpack is 1-indexed
        $valueLength = (\ord($line[0]) << 8) + \ord($line[1]);
        $line = substr($line, 2);

        // value
        // This can contain newlines, so we may need to read more lines
        while (\strlen($line) <= $valueLength) {
            $line .= fgets($fp);
        }
        $value = substr($line, 0, $valueLength);
        $line = substr($line, $valueLength);

        // ['&' mask]
        $mask = '';
        if (str_starts_with($line, '&')) {
            // This can contain newlines, so we may need to read more lines
            while (\strlen($line) <= $valueLength) {
                $line .= fgets($fp);
            }
            $mask = substr($line, 1, $valueLength);
            $line = substr($line, $valueLength + 1);
        }

        // ['~' word-size] ['+' range-length]
        if (!preg_match(self::RULE_END_RX, $line, $ending)) {
            // Per the spec, this must be caught and ignored, to allow for future extensions.
            throw new UnknownMagicRule($line);
        }
        $wordSize = \intval($ending['word_size'] ?? 1);
        $range = \intval($ending['range'] ?? 1);

        return new Rule($nestDepth, $startOffset, $valueLength, $value, $mask, $wordSize, $range);
    }

    private function finalize(array $rules): MagicDatabase
    {
        $maxLength = 0;
        $allTypes = [];

        foreach ($rules as $type => $typeRules) {
            foreach ($typeRules as [$priority, $rule]) {
                $allTypes[] = [$priority, $type, $rule];
                $maxLength = max($maxLength, $rule->getMaxLength());
            }
        }

        usort($allTypes, fn(array $a, array $b) => $b[0] - $a[0]);

        return new MagicDatabase($allTypes, $maxLength);
    }
}
