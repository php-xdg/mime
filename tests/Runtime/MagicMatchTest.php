<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Runtime;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Runtime\MagicMatch;

final class MagicMatchTest extends TestCase
{
    /**
     * @dataProvider matchChildrenProvider
     */
    public function testMatchChildren(MagicMatch $match, string $subject, bool $expected): void
    {
        Assert::assertSame($expected, $match->matches($subject, \strlen($subject)));
    }

    public function matchChildrenProvider(): iterable
    {
        yield 'single child' => [
            new MagicMatch(0, 1, 'foo', '', 0, [
                new MagicMatch(3, 1, 'bar'),
            ]),
            'foobar',
            true,
        ];
        yield 'single child #2' => [
            new MagicMatch(0, 1, 'foo', '', 0, [
                new MagicMatch(3, 1, 'baz'),
            ]),
            'foobar',
            false,
        ];
        yield 'several children' => [
            new MagicMatch(0, 1, 'foo', '', 0, [
                new MagicMatch(3, 1, 'bar'),
                new MagicMatch(3, 1, 'baz'),
                new MagicMatch(3, 1, 'qux'),
            ]),
            'fooqux',
            true,
        ];
        yield 'several children #2' => [
            new MagicMatch(0, 1, 'foo', '', 0, [
                new MagicMatch(3, 1, 'bar'),
                new MagicMatch(3, 1, 'baz'),
            ]),
            'fooqux',
            false,
        ];
    }

    /**
     * @dataProvider matchWithMaskProvider
     */
    public function testMatchWithMask(MagicMatch $match, string $subject, bool $expected): void
    {
        Assert::assertSame($expected, $match->matches($subject, \strlen($subject)));
    }

    public function matchWithMaskProvider(): iterable
    {
        yield '0xFF mask is the same as no mask' => [
            new MagicMatch(0, 1, 'foo', "\xFF\xFF\xFF"),
            'foo',
            true,
        ];
        yield '0xFF mask is the same as no mask #2' => [
            new MagicMatch(0, 1, 'foo', "\xFF\xFF\xFF"),
            'FOO',
            false,
        ];
        yield '0x00 mask matches anything' => [
            new MagicMatch(0, 1, 'foo', "\x00\x00\x00"),
            'bar',
            true,
        ];
        yield 'mix of 0xFF and 0x00' => [
            new MagicMatch(0, 1, 'bar', "\xFF\xFF\x00"),
            'baz',
            true,
        ];
        yield '0x00 & 0x80 matches any 7-bit character' => [
            new MagicMatch(0, 1, "\x00\x00\x00", "\x80\x80\x80"),
            'baz',
            true,
        ];
        yield '0x00 & 0x80 matches any 7-bit character #2' => [
            new MagicMatch(0, 1, "\x00\x00\x00", "\x80\x80\x80"),
            "\xFF\xFF\xFF",
            false,
        ];
    }

    /**
     * @dataProvider itSwapsBytesProvider
     */
    public function testItSwapsBytes(string $value, int $wordSize, string $expected): void
    {
        $match = new MagicMatch(0, 1, $value, $value, 1|$wordSize);
        Assert::assertSame($expected, $match->value);
        Assert::assertSame($expected, $match->mask);
    }

    public function itSwapsBytesProvider(): iterable
    {
        yield 'wordSize = 2 (16-bits)' => [
            "\x01\x00\xFF\x00",
            2,
            "\x00\x01\x00\xFF",
        ];
        yield 'wordSize = 4 (32-bits)' => [
            "\x01\x00\xFF\x00",
            4,
            "\x00\xFF\x00\x01",
        ];
    }
}
