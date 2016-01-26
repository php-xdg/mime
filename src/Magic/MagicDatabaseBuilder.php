<?php

namespace ju1ius\XDGMime\Magic;

use ju1ius\XDGMime\ParsingError;

/**
 * @author ju1ius
 */
class MagicDatabaseBuilder
{
    const RULE_END_RX = '/
        (?:~(\d+))?
        (?:\+(\d+))?
        \n
        $
    /Sx';

    public function build(array $files)
    {
        $rules = [];
        foreach ($files as $file) {
            $this->parseFile($file, $rules);
        }
        return $this->finalize($rules);
    }

    private function parseFile($filepath, &$rules)
    {
        $fp = fopen($filepath, 'rb');
        $line = fgets($fp);
        if ($line !== "MIME-Magic\0\n") {
            throw new ParsingError('Invalid MIME Magic file');
        }
        while (true) {
            $heading = fgets($fp);
            if (!$heading) {
                break;
            }
            if ($heading[0] !== '[' || substr($heading, -2) !== "]\n") {
                throw new ParsingError("Malformed magic section heading: {$heading}");
            }
            list($priority, $type) = explode(':', substr($heading, 1, -2), 2);
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
     *
     * @return MagicRuleComposite|MagicRule|null
     */
    private function parseCompositeRule($fp)
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
            if ($char) fseek($fp, -1, SEEK_CUR);
        }

        $tree = [];
        $insertPoints = [0 => &$tree];
        foreach ($depthRules as $rule) {
            $subrules = [];
            $insertPoints[$rule->depth][] = [$rule, $subrules];
            $insertPoints[$rule->depth + 1] = $subrules;
        }

        return $this->parseRuleTree($tree);
    }

    /**
     * @param array $tree
     *
     * @return MagicRuleComposite|MagicRule|null
     */
    private function parseRuleTree($tree)
    {
        $rules = [];
        /**
         * @var MagicRule $rule
         * @var  array $subrules
         */
        foreach ($tree as list($rule, $subrules)) {
            if (!empty($subrules)) {
                $rule->next = $this->parseRuleTree($subrules);
            }
            $rules[] = $rule;
        }
        $numRules = count($rules);
        if ($numRules === 1) {
            return $rules[0];
        }
        if ($numRules > 1) {
            return new MagicRuleComposite($rules);
        }
    }

    /**
     * @param resource $fp
     *
     * @return MagicRule
     * @throws UnknownMagicRule
     * @throws DiscardMagicRules
     */
    private function parseRule($fp)
    {
        $line = fgets($fp);

        // [indent] '>'
        list($nestDepth, $line) = explode('>', $line, 2);
        $nestDepth = $nestDepth ? (int) $nestDepth : 0;

        // start-offset '='
        list($startOffset, $line) = explode('=', $line, 2);
        $startOffset = (int) $startOffset;

        if ($line === "__NOMAGIC__\n") {
            throw new DiscardMagicRules();
        }
        // value length (2 bytes, big endian)
        //$valueLength = unpack('n', $line)[1]; // unpack is 1-indexed
        $valueLength = (ord($line[0]) << 8) + ord($line[1]);
        $line = substr($line, 2);

        // value
        // This can contain newlines, so we may need to read more lines
        while (strlen($line) <= $valueLength) {
            $line .= fgets($fp);
        }
        $value = substr($line, 0, $valueLength);
        $line = substr($line, $valueLength);

        // ['&' mask]
        $mask = null;
        if (strpos($line, '&') === 0) {
            // This can contain newlines, so we may need to read more lines
            while (strlen($line) <= $valueLength) {
                $line .= fgets($fp);
            }
            $mask = substr($line, 1, $valueLength + 1);
            $line = substr($line, $valueLength + 1);
        }

        // ['~' word-size] ['+' range-length]
        $ending = preg_match(self::RULE_END_RX, $line);
        if (!$ending) {
            // Per the spec, this must be caught and ignored, to allow for future extensions.
            throw new UnknownMagicRule($line);
        }
        $wordSize = empty($ending[1]) ? 1 : (int) $ending[1];
        $range = empty($ending[2]) ? 1 : (int) $ending[2];

        return new MagicRule($nestDepth, $startOffset, $valueLength, $value, $mask, $wordSize, $range);
    }

    /**
     * @param array $rules
     *
     * @return MagicDatabase
     */
    private function finalize(array $rules) {
        $maxLength = 0;
        $allTypes = [];

        foreach ($rules as $type => $typeRules) {
            foreach ($typeRules as list($priority, $rule)) {
                $allTypes[] = [$priority, $type, $rule];
                $maxLength = max($maxLength, $rule->getMaxLength());
            }
        }

        usort($allTypes, function ($a, $b) {
            return $b[0] - $a[0];
        });

        return new MagicDatabase($allTypes, $maxLength);
    }
}