<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

final class TreeMagicTestDTO
{
    public function __construct(
        public readonly string $path,
        public readonly array $types,
        public readonly bool $xFail = false,
    ) {
    }

    public function __toString(): string
    {
        $output = [
            $this->path,
            ...$this->types,
        ];
        if ($this->xFail) {
            array_unshift($output, 'x');
        }

        return implode(' ', $output);
    }
}
