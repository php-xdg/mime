<?php declare(strict_types=1);

namespace Xdg\Mime\Tests;

use PHPUnit\Framework\Assert;
use Xdg\Mime\MimeType;

final class MimeTypeAssert
{
    public static function equals(MimeType|string $expected, MimeType|string $actual): void
    {
        Assert::assertEqualsIgnoringCase((string)$expected, (string)$actual);
    }
}
