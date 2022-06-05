<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Magic;

abstract class AbstractRule
{
    public ?AbstractRule $next = null;

    abstract public function matches(string $buffer, ?int $length = null): bool;

    abstract public function getMaxLength(): int;
}
