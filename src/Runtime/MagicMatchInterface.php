<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

/**
 * @internal
 */
interface MagicMatchInterface
{
    public function matches(string $buffer, int $length): bool;
}
