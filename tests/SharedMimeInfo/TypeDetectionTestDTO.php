<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\SharedMimeInfo;

use Symfony\Component\Filesystem\Path;
use Xdg\Mime\Tests\ResourceHelper;

final class TypeDetectionTestDTO
{
    public function __construct(
        public readonly string $filename,
        public readonly string $expectedType,
        public readonly bool $filenameLookupXFail = false,
        public readonly bool $magicLookupXFail = false,
        public readonly bool $fullLookupXFail = false,
    ) {
    }

    public function __toString(): string
    {
        $flags = array_map(fn($f) => $f ? 'x' : 'o', [
            $this->filenameLookupXFail,
            $this->magicLookupXFail,
            $this->fullLookupXFail,
        ]);
        return implode(' ', [
            Path::makeRelative($this->filename, ResourceHelper::getSharedMimeInfoPath('tests/mime-detection')),
            $this->expectedType,
            implode('', $flags),
        ]);
    }
}
