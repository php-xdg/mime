<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test;

use ju1ius\XDGMime\MimeType;
use PHPUnit\Framework\Assert;

final class MimeTypeAssert
{
    public static function equals(MimeType|string $expected, MimeType|string $actual): void
    {
        //Assert::assertSame(MimeType::of($expected), MimeType::of($actual));
        Assert::assertEqualsIgnoringCase((string)$expected, (string)$actual);
    }
}