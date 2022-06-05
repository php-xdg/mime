<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Magic;

/**
 * Match any of a set of magic rules.
 *
 * @internal
 */
final class CompositeRule extends AbstractRule
{
    /**
     * @param AbstractRule[] $rules
     */
    public function __construct(
        private readonly array $rules,
    ) {
    }

    public function matches(string $buffer, ?int $length = null): bool
    {
        $length ??= \strlen($buffer);
        foreach ($this->rules as $rule) {
            if ($rule->matches($buffer, $length)) {
                return true;
            }
        }
        return false;
    }

    public function getMaxLength(): int
    {
        return max(array_map(fn(AbstractRule $rule) => $rule->getMaxLength(), $this->rules));
    }
}
