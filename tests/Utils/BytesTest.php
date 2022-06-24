<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Utils;

use ju1ius\XdgMime\Test\ResourceHelper;
use ju1ius\XdgMime\Utils\Bytes;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class BytesTest extends TestCase
{
    /**
     * @dataProvider swapProvider
     */
    public function testSwap(string $bytes, int $wordSize, string $expected): void
    {
        Assert::assertSame($expected, Bytes::be2le($bytes, $wordSize));
    }

    public function swapProvider(): \Traversable
    {
        yield ["\xFF\x00", 2, "\x00\xFF"];
        yield ["\xFF\x00\xFF\x00", 2, "\x00\xFF\x00\xFF"];
        yield ["\xFF\x00\x00\x00", 4, "\x00\x00\x00\xFF"];
        yield ["\xFF\x00\x00\x00\xFF\xFF\x00\x00", 4, "\x00\x00\x00\xFF\x00\x00\xFF\xFF"];
    }

    /**
     * @dataProvider plainTextSniffingProvider
     */
    public function testPlainTextSniffing(string $input, bool $expected): void
    {
        Assert::assertSame($expected, Bytes::looksLikePlainText($input));
    }

    public function plainTextSniffingProvider(): iterable
    {
        yield 'ASCII only' => [
            'This is some plain text.',
            true,
        ];
        yield 'UTF-8 characters' => [
            'This is 💩.',
            true,
        ];
        yield 'UTF-8 BOM' => [
            "\xEF\xBB\xBFThis is 💩💩💩.",
            true,
        ];
        yield 'UTF-8 (chinese)' => [
            '仙人洞文化係話到萬年大源盆地一隻叫仙人洞嗰溶洞發現嗰史前文化。',
            true,
        ];
        yield 'SHIFT_JIS' => [
            self::readTextFile('shift_jis.txt'),
            true,
        ];
        // The following are expected to not be detected as plain-text
        yield 'UTF-16' => [
            mb_convert_encoding('This is 💩.', 'utf16', 'utf8'),
            false,
        ];
        yield 'UTF-32' => [
            mb_convert_encoding('This is 💩.', 'utf32', 'utf8'),
            false,
        ];
    }

    private static function readTextFile(string $filename): string
    {
        return file_get_contents(ResourceHelper::getFilePath('text-plain/' . $filename));
    }
}
