<?php

namespace ju1ius\XDGMime\Magic;

/**
 * Thrown when the __NOMAGIC__ marker is found in a MagicRule,
 * and caught to discard previous rules.
 *
 * @internal
 * @author ju1ius
 */
class DiscardMagicRules extends \RuntimeException
{

}