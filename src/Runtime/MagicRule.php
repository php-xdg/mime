<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

/**
 * @internal
 */
final class MagicRule implements MagicMatchInterface
{
    /**
     * @param MagicMatchInterface[] $matchlets
     */
    public function __construct(
        public readonly string $type,
        public readonly int $priority,
        public readonly int $maxLength,
        public readonly array $matchlets,
    ) {
    }

    public function matches(string $buffer, int $length): bool
    {
        foreach ($this->matchlets as $matchlet) {
            if ($matchlet->matches($buffer, $length)) {
                return true;
            }
        }
        return false;
    }
}
