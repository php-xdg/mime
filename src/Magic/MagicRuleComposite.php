<?php

namespace ju1ius\XDGMime\Magic;


/**
 * Match any of a set of magic rules.
 *
 * @author ju1ius
 * @internal
 */
class MagicRuleComposite implements MagicRuleInterface
{
    /**
     * @var MagicRuleInterface[]
     */
    private $rules;

    /**
     * @var MagicRuleInterface
     */
    public $next = null;

    /**
     * MagicRuleComposite constructor.
     *
     * @param MagicRuleInterface[] $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
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
        foreach ($this->rules as $rule) {
            if ($rule->matches($buffer, $buflen)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getMaxLength()
    {
        return max(array_map(function ($rule) {
            /** @var MagicRuleInterface $rule */
            return $rule->getMaxLength();
        }, $this->rules));
    }
}