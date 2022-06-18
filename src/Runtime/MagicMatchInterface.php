<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

/**
 * @internal
 */
interface MagicMatchInterface
{
    public function matches(string $buffer, int $length): bool;
}
