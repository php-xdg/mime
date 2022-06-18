<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

/**
 * @internal
 */
final class MagicRegex implements MagicMatchInterface
{
    public function __construct(
        private readonly string $pattern,
        private readonly array $and = [],
    ) {
    }

    public function matches(string $buffer, int $length): bool
    {
        if (!preg_match($this->pattern, $buffer)) {
            return false;
        }
        if (!$this->and) {
            return true;
        }
        foreach ($this->and as $matchlet) {
            if ($matchlet->matches($buffer, $length)) {
                return true;
            }
        }
        return false;
    }
}
