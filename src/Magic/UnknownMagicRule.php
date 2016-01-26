<?php

namespace ju1ius\XDGMime\Magic;

/**
 * Thrown when a magic rule is not recognized while parsing.
 * Per the spec, this exception will be caught and ignored,
 * to allow for future extensions.
 *
 * @author ju1ius
 * @internal
 */
class UnknownMagicRule extends \RuntimeException
{

}