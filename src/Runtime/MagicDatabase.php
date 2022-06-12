<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

final class MagicDatabase
{
    /**
     * @param MagicRule[] $rules
     */
    public function __construct(
        private readonly int $lookupBufferSize,
        private readonly array $rules,
    ) {
    }

    public function match(string $path, ?array $allowedTypes = null): ?string
    {
        if (false === $fp = @fopen($path, 'rb')) {
            return null;
        }
        if (false === $buffer = @fread($fp, $this->lookupBufferSize)) {
            fclose($fp);
            return null;
        }
        fclose($fp);

        return $this->matchData($buffer, $allowedTypes);
    }

    public function matchData(string $data, ?array $allowedTypes = null): ?string
    {
        if ($allowedTypes) {
            $rules = array_filter($this->rules, fn($r) => $allowedTypes[$r->type] ?? false);
        } else {
            $rules = $this->rules;
        }

        $length = min(\strlen($data), $this->lookupBufferSize);

        foreach ($rules as $rule) {
            if ($rule->matches($data, $length)) {
                return $rule->type;
            }
        }

        if ($this->looksLikePlainText($data)) {
            return 'text/plain';
        }

        return null;
    }

    private function looksLikePlainText(string $data): bool
    {
        return (bool)preg_match('/\A[^\x00-\x08\x0E-\x1F\x7F]+\z/Sx', substr($data, 0, 32));
    }
}
