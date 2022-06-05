<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Exception;

/**
 * Thrown when the `__NOMAGIC__` marker is found in a MagicRule, and caught to discard previous rules.
 * @internal
 */
final class DiscardMagicRules extends \RuntimeException
{
}
