<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Exception;

/**
 * Thrown when a magic rule type is unknown.
 *
 * Per the spec, this must be caught and ignored to allow for future extensions.
 *
 * @internal
 */
final class UnknownMagicType extends ParseError
{
}
