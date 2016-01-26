<?php

namespace ju1ius\XDGMime\Magic;


/**
 * @author ju1ius
 */
class MagicDatabase
{
    /**
     * [
     *    'mimetype' => [[$priority, $rule], ...],
     *    ...
     * ]
     *
     * @var array
     */
    private $rules;

    /**
     * @var integer
     */
    private $maxRuleLength;

    /**
     * MagicDatabase constructor.
     *
     * @param array $rules
     * @param int   $maxRuleLength
     */
    public function __construct(array $rules, $maxRuleLength)
    {
        $this->rules = $rules;
        $this->maxRuleLength = $maxRuleLength;
    }

    /**
     * Read data from the file and do magic sniffing on it.
     *
     * $maxPriority & $minPriority can be used to specify the maximum & minimum priority rules to look for.
     * $possible can be a list of mimetypes to check,
     * or null (the default) to check all mimetypes until one matches.
     *
     * Returns the MIMEtype found, or null if no entries match.
     * Raises IOError if the file can't be opened.
     *
     * @param string     $path
     * @param int        $maxPriority
     * @param int        $minPriority
     * @param array|null $possible
     *
     * @return string|null
     */
    public function match($path, $maxPriority = 100, $minPriority = 0, $possible = null)
    {
        $fp = fopen($path, 'rb');
        $buffer = fread($fp, $this->maxRuleLength);
        fclose($fp);

        if ($buffer === false) {
            return;
        }

        return $this->matchData($buffer, $maxPriority, $minPriority, $possible);
    }

    public function matchData($data, $maxPriority = 100, $minPriority = 0, $possible = null)
    {
        if ($possible) {
            $types = [];
            foreach ($possible as $type) {
                foreach ($this->rules[$type] as list($priority, $rule)) {
                    $types[] = [$priority, $type, $rule];
                }
            }
            usort($types, function ($a, $b) {
                return $a[0] - $b[0];
            });
        } else {
            $types = $this->rules;
        }

        $data = substr($data, 0, $this->maxRuleLength);
        $buflen = strlen($data);

        /**
         * @var int $priority
         * @var string $type
         * @var MagicRuleInterface $rule
         */
        foreach ($types as list($priority, $type, $rule)) {
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
    }
}