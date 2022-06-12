<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

final class TestDTO
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
            $this->filename,
            $this->expectedType,
            implode('', $flags),
        ]);
    }
}
