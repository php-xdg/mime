<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Exception;

/**
 * Thrown when a magic rule is not recognized while parsing.
 * Per the spec, this exception will be caught and ignored, to allow for future extensions.
 *
 * @internal
 */
final class UnknownMagicRule extends \RuntimeException
{
}
