<?php

namespace ju1ius\XDGMime\Magic;


/**
 * A Magic rule is a linked list of rules.
 *
 * @author ju1ius
 *
 * @internal
 */
class MagicRule implements MagicRuleInterface
{
    /**
     * @var int
     */
    public $depth;
    /**
     * @var int
     */
    public $start;
    /**
     * @var string
     */
    public $value;
    /**
     * @var int
     */
    public $valueLength;
    /**
     * @var int
     */
    public $mask;
    /**
     * @var int
     */
    public $wordSize;
    /**
     * @var int
     */
    public $range;

    /**
     * @var MagicRuleInterface
     */
    public $next = null;

    /**
     * MagicRule constructor.
     *
     * @param integer $depth
     * @param integer $start
     * @param integer $valueLength
     * @param string $value
     * @param integer $mask
     * @param integer $wordSize
     * @param integer $range
     */
    public function __construct($depth, $start, $valueLength,  $value, $mask, $wordSize, $range)
    {
        $this->depth = $depth;
        $this->start = $start;
        $this->valueLength = $valueLength;
        $this->value = $value;
        $this->mask = $mask;
        $this->wordSize = $wordSize;
        $this->range = $range;
    }

    /**
     * @param string   $buffer
     * @param int|null $buflen
     *
     * @return bool
     */
    public function matches($buffer, $buflen=null)
    {
        if ($buflen === null) {
            $buflen = strlen($buffer);
        }

        if ($this->matchSingle($buffer, $buflen)) {
            if ($this->next) {
                return $this->next->matches($buffer, $buflen);
            }
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getMaxLength()
    {
        $length = $this->start + $this->valueLength + $this->range;
        if ($this->next) {
            return max($length, $this->next->getMaxLength());
        }

        return $length;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $out = '';
        if ($this->depth) {
            $out .= $this->depth;
        }
        $out .= '>' . $this->start;
        $out .= '=' . pack('n', $this->valueLength) . $this->value;
        if ($this->mask) {
            $out .= '&' . $this->mask;
        }
        if ($this->wordSize) {
            $out .= '~' . $this->wordSize;
        }
        if ($this->range) {
            $out .= '+' . $this->range;
        }
        return $out;
    }

    /**
     * @param string  $buffer
     * @param integer $buflen
     *
     * @return bool
     */
    private function matchSingle($buffer, $buflen)
    {
        for ($o = 0; $o < $this->range; $o++) {
            $start = $this->start + $o;
            $end = $start + $this->valueLength;
            if ($buflen < $end) {
                return false;
            }
            $test = '';
            if ($this->mask) {
                for ($i = 0; $i < $this->valueLength; $i++) {
                    //$c = ord($buffer[$start + $i]) & ord($this->mask[$i]);
                    //$test .= chr($c);
                    $test .= $buffer[$start + $i] & $this->mask[$i];
                }
            } else {
                $test = substr($buffer, $start, $end);
            }
            if ($test === $this->value) {
                return true;
            }
        }

        return false;
    }
}