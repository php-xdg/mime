<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

/**
 * @internal
 */
interface MagicMatchInterface
{
    public function matches(string $buffer, int $length): bool;
}
