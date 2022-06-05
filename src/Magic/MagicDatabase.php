<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Magic;

final class MagicDatabase
{
    /**
     * @param array<string, array{int, AbstractRule}[]> $rules
     * @param int $maxRuleLength
     */
    public function __construct(
        private readonly array $rules,
        private readonly int $maxRuleLength,
    ) {
    }

    /**
     * Read data from the file and do magic sniffing on it.
     *
     * `$maxPriority` & `$minPriority` can be used to specify the maximum & minimum priority rules to look for.
     *
     * `$possible` can be a list of mimetypes to check, or null (the default) to check all mimetypes until one matches.
     *
     * Returns the MIME type found, or null if no entries match.
     * Raises IOError if the file can't be opened.
     */
    public function match(string $path, int $maxPriority = 100, int $minPriority = 0, ?array $possible = null): ?string
    {
        $fp = fopen($path, 'rb');
        $buffer = fread($fp, $this->maxRuleLength);
        fclose($fp);

        if ($buffer === false) {
            return null;
        }

        return $this->matchData($buffer, $maxPriority, $minPriority, $possible);
    }

    public function matchData(
        string $data,
        int $maxPriority = 100,
        int $minPriority = 0,
        ?array $possible = null
    ): ?string {
        if ($possible) {
            $types = [];
            foreach ($possible as $type) {
                foreach ($this->rules[$type] as [$priority, $rule]) {
                    $types[] = [$priority, $type, $rule];
                }
            }
            usort($types, fn(array $a, array $b) => $a[0] - $b[0]);
        } else {
            $types = $this->rules;
        }

        $data = substr($data, 0, $this->maxRuleLength);
        $buflen = \strlen($data);

        /**
         * @var int $priority
         * @var string $type
         * @var AbstractRule $rule
         */
        foreach ($types as [$priority, $type, $rule]) {
            if ($priority > $maxPriority) {
                continue;
            }
            if ($priority < $minPriority) {
                break;
            }
            if ($rule->matches($data, $buflen)) {
                return $type;
            }
        }

        return null;
    }
}
