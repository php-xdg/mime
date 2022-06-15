<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

use ju1ius\XDGMime\Test\ResourceHelper;
use Symfony\Component\Filesystem\Path;

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
            Path::makeRelative($this->path, ResourceHelper::getSharedMimeInfoPath('tests/mime-detection')),
            ...$this->types,
        ];
        if ($this->xFail) {
            array_unshift($output, 'x');
        }

        return implode(' ', $output);
    }
}
