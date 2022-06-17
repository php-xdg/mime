<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\AST;

/**
 * @internal
 */
final class GlobNode extends Node
{
    public readonly bool $isExtensionGlob;
    public readonly ?string $extension;
    public readonly bool $isLiteral;

    public function __construct(
        public readonly string $type,
        public readonly int $weight,
        public readonly string $pattern,
        public readonly bool $caseSensitive = false,
    ) {
        $this->isExtensionGlob = str_starts_with($pattern, '*.');
        if ($this->isExtensionGlob) {
            $pattern = substr($pattern, 2);
            $this->extension = $pattern;
        }
        $this->isLiteral = (bool)preg_match('/^[^\[*?]+$/', $pattern);
    }
}
