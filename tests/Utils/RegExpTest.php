<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Utils;

use ju1ius\XdgMime\Utils\RegExp;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class RegExpTest extends TestCase
{
    /**
     * @dataProvider byteSetToCharacterClassProvider
     */
    public function testByteSetToCharacterClass(array $bytes, string $expected): void
    {
        Assert::assertSame($expected, RegExp::byteSetToCharacterClass(...$bytes));
    }

    public static function byteSetToCharacterClassProvider(): iterable
    {
        yield 'uppercase' => [
            range(\ord('A'), \ord('Z')),
            'A-Z',
        ];
        yield 'alphanumeric' => [
            [
                ...range(\ord('0'), \ord('9')),
                ...range(\ord('a'), \ord('z')),
                ...range(\ord('A'), \ord('Z')),
            ],
            '0-9A-Za-z',
        ];
        yield 'mixed' => [
            [
                ...range(0x00, 0x20),
                ...range(\ord('a'), \ord('z')),
                \ord('X'),
                0x7F,
            ],
            '\x00-\x20Xa-z\x7F',
        ];
    }
}
