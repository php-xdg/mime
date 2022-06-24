<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test;

use ju1ius\XdgMime\MimeType;
use PHPUnit\Framework\Assert;

final class MimeTypeAssert
{
    public static function equals(MimeType|string $expected, MimeType|string $actual): void
    {
        Assert::assertEqualsIgnoringCase((string)$expected, (string)$actual);
    }
}
