<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

/**
 * @internal
 */
final class MagicDatabase
{
    /**
     * @param MagicMatchInterface[] $rules
     */
    public function __construct(
        private readonly int $lookupBufferSize,
        private readonly array $rules,
    ) {
    }

    public function match(string $path, ?array $allowedTypes = null): ?string
    {
        [$rules, $lookupBufferSize] = $this->filterRules($allowedTypes);

        $buffer = @file_get_contents($path, false, null, 0, $lookupBufferSize);
        if ($buffer === false) {
            return null;
        }

        return $this->matchBuffer($buffer, $rules, $lookupBufferSize);
    }

    public function matchData(string $data, ?array $allowedTypes = null): ?string
    {
        [$rules, $lookupBufferSize] = $this->filterRules($allowedTypes);

        return $this->matchBuffer($data, $rules, $lookupBufferSize);
    }

    private function matchBuffer(string $buffer, array $rules, int $length): ?string
    {
        $length = min(\strlen($buffer), $length);
        foreach ($rules as $rule) {
            if ($rule->matches($buffer, $length)) {
                return $rule->type;
            }
        }
        if ($this->looksLikePlainText($buffer)) {
            return 'text/plain';
        }

        return null;
    }

    private function filterRules(?array $allowedTypes = null): array
    {
        if (!$allowedTypes) {
            return [$this->rules, $this->lookupBufferSize];
        }
        $rules = [];
        $lookupBufferSize = 0;
        foreach ($this->rules as $rule) {
            if ($allowedTypes[$rule->type] ?? false) {
                $rules[] = $rule;
                $lookupBufferSize = max($lookupBufferSize, $rule->maxLength);
            }
        }
        return [$rules, $lookupBufferSize];
    }

    private function looksLikePlainText(string $data): bool
    {
        return (bool)preg_match('/\A[^\x00-\x08\x0E-\x1F\x7F]+\z/Sx', substr($data, 0, 32));
    }
}
