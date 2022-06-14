<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\Utils;

use ju1ius\XDGMime\Utils\Bytes;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class BytesTest extends TestCase
{
    /**
     * @dataProvider swapProvider
     */
    public function testSwap(string $bytes, int $wordSize, string $expected): void
    {
        Assert::assertSame($expected, Bytes::swap($bytes, $wordSize));
    }

    public function swapProvider(): \Traversable
    {
        yield ["\xFF\x00", 2, "\x00\xFF"];
        yield ["\xFF\x00\xFF\x00", 2, "\x00\xFF\x00\xFF"];
        yield ["\xFF\x00\x00\x00", 4, "\x00\x00\x00\xFF"];
        yield ["\xFF\x00\x00\x00\xFF\xFF\x00\x00", 4, "\x00\x00\x00\xFF\x00\x00\xFF\xFF"];
    }
}
