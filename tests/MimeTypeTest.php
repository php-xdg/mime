<?php declare(strict_types=1);

namespace Xdg\Mime\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Exception\InvalidMimeType;
use Xdg\Mime\MimeType;

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

    public function testItCannotBeCloned(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $type = MimeType::defaultText();
        $other = clone $type;
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
        $type = MimeType::defaultBinary();
        Assert::assertSame($type, MimeType::of($type));
    }

    /**
     * @dataProvider isProvider
     */
    public function testIs(MimeType $type, MimeType|string $other, bool $expected): void
    {
        Assert::assertSame($expected, $type->is($other));
    }

    public function isProvider(): iterable
    {
        yield  [MimeType::of('foo/bar'), MimeType::of('foo/bar'), true];
        yield  [MimeType::of('foo/bar'), MimeType::of('Foo/Bar'), true];
        yield  [MimeType::of('foo/bar'), MimeType::of('foo/baz'), false];
        yield  [MimeType::of('foo/bar'), 'foo/bar', true];
        yield  [MimeType::of('foo/bar'), 'Foo/Bar', true];
        yield  [MimeType::of('foo/bar'), 'foo/baz', false];
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

    public function testWithSubtype(): void
    {
        $plain = MimeType::of('text/plain');
        $html = $plain->withSubtype('html');
        Assert::assertSame(MimeType::of('text/html'), $html);
    }

    /**
     * @dataProvider knownTypesConstructorsProvider
     */
    public function testKnownTypesConstructors(callable $fn, string $expected): void
    {
        Assert::assertSame(MimeType::of($expected), $fn());
    }

    public function knownTypesConstructorsProvider(): \Traversable
    {
        yield [MimeType::defaultText(...), 'text/plain'];
        yield [MimeType::defaultBinary(...), 'application/octet-stream'];
        yield [MimeType::defaultExecutable(...), 'application/x-executable'];
        yield [MimeType::directory(...), 'inode/directory'];
        yield [MimeType::symlink(...), 'inode/symlink'];
        yield [MimeType::characterDevice(...), 'inode/chardevice'];
        yield [MimeType::blockDevice(...), 'inode/blockdevice'];
        yield [MimeType::fifo(...), 'inode/fifo'];
        yield [MimeType::socket(...), 'inode/socket'];
        yield [MimeType::door(...), 'inode/door'];
    }
}
