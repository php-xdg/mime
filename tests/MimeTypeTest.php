<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test;

use ju1ius\XDGMime\Exception\InvalidMimeType;
use ju1ius\XDGMime\MimeType;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class MimeTypeTest extends TestCase
{
    public function testThatItParsesCorrectly(): void
    {
        $type = MimeType::of('text/plain');
        Assert::assertSame('text', $type->media);
        Assert::assertSame('plain', $type->subtype);

        $type = MimeType::of('application/vnd.stuff.x-foo');
        Assert::assertSame('application', $type->media);
        Assert::assertSame('vnd.stuff.x-foo', $type->subtype);
    }

    /**
     * @dataProvider invalidMimeTypeProvider
     */
    public function testThatItRaisesInvalidMimeType($mime): void
    {
        $this->expectException(InvalidMimeType::class);
        MimeType::of($mime);
    }

    public function invalidMimeTypeProvider(): \Traversable
    {
        yield ['application'];
        yield ['application/foo/bar/baz'];
    }

    public function testMimeTypeStrictEquality(): void
    {
        Assert::assertSame(MimeType::of('audio/mpeg'), MimeType::of('audio/mpeg'));
    }

    /**
     * @dataProvider toStringProvider
     */
    public function testThatItConvertsToString($mime): void
    {
        Assert::assertSame($mime, (string)MimeType::of($mime));
    }

    public function toStringProvider(): \Traversable
    {
        yield ['inode/door'];
        yield ['application/vdn.foo-bar.x-baz'];
    }

    public function testThatMimeTypesAreCaseInsensitive(): void
    {
        $type = MimeType::of('image/JPEG');
        Assert::assertSame('image', $type->media);
        Assert::assertSame('jpeg', $type->subtype);
    }
}
