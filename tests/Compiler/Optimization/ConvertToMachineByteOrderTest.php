<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Compiler\Optimization;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Compiler\Optimization\Magic\ConvertToMachineByteOrder;
use Xdg\Mime\Parser\AST\MagicMatchNode;

final class ConvertToMachineByteOrderTest extends TestCase
{
    #[DataProvider('itConvertsToLittleEndianProvider')]
    public function testItConvertsToLittleEndian(MagicMatchNode $input, bool $swap, MagicMatchNode $expected): void
    {
        Assert::assertEquals($expected, self::apply($input, $swap));
    }

    public static function itConvertsToLittleEndianProvider(): iterable
    {
        yield '8-bit values' => [
            new MagicMatchNode('string', 0, 1, "\xFF\x00", "\xFF\x00", 1),
            true,
            new MagicMatchNode('string', 0, 1, "\xFF\x00", "\xFF\x00", 1),
        ];
        yield 'swaps 16-bit values' => [
            new MagicMatchNode('string', 0, 1, "\xFF\x00\xFF\x00", "\xFF\x00\xFF\x00", 2),
            true,
            new MagicMatchNode('string', 0, 1, "\x00\xFF\x00\xFF", "\x00\xFF\x00\xFF", 1),
        ];
        yield 'does not swap 16-bit values if platform is big endian' => [
            new MagicMatchNode('string', 0, 1, "\xFF\x00\xFF\x00", "\xFF\x00\xFF\x00", 2),
            false,
            new MagicMatchNode('string', 0, 1, "\xFF\x00\xFF\x00", "\xFF\x00\xFF\x00", 1),
        ];
        yield 'swaps 32-bit values' => [
            new MagicMatchNode('string', 0, 1, "\xFF\x00\x00\x00\xFF\xFF\x00\x00", "\xFF\x00\x00\x00\xFF\xFF\x00\x00", 4),
            true,
            new MagicMatchNode('string', 0, 1, "\x00\x00\x00\xFF\x00\x00\xFF\xFF", "\x00\x00\x00\xFF\x00\x00\xFF\xFF", 1),
        ];
        yield 'does not swap 32-bit values if platform is big endian' => [
            new MagicMatchNode('string', 0, 1, "\xFF\x00\x00\x00\xFF\xFF\x00\x00", "\xFF\x00\x00\x00\xFF\xFF\x00\x00", 4),
            false,
            new MagicMatchNode('string', 0, 1, "\xFF\x00\x00\x00\xFF\xFF\x00\x00", "\xFF\x00\x00\x00\xFF\xFF\x00\x00", 1),
        ];
    }

    private static function apply(MagicMatchNode $node, bool $littleEndian): MagicMatchNode
    {
        $optimization = new ConvertToMachineByteOrder($littleEndian);
        return $optimization->leaveNode($optimization->enterNode($node));
    }
}
