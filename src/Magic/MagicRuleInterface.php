<?php

namespace ju1ius\XDGMime\Magic;

/**
 * @author ju1ius
 */
interface MagicRuleInterface
{
    /**
     * @param string   $buffer
     * @param int|null $buflen
     *
     * @return bool
     */
    public function matches ($buffer, $buflen=null);

    /**
     * @return integer
     */
    public function getMaxLength();
}