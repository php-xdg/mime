<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Utils;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Utils\Iter;

final class IterTest extends TestCase
{
    /**
     * @dataProvider chunkWhileProvider
     */
    public function testChunkWhile(iterable $col, callable $predicate, array $expected): void
    {
        $result = iterator_to_array(Iter::chunkWhile($col, $predicate), false);
        Assert::assertSame($expected, $result);
    }

    public function chunkWhileProvider(): iterable
    {
        yield 'empty collection' => [
            [], fn() => true, [],
        ];
        yield 'unary collection' => [
            [1], fn() => true, [[1]],
        ];
        yield 'yields a single chunk if predicate is always true' => [
            [1, 2, 3], fn() => true, [[1, 2, 3]],
        ];
        yield 'yields unary chunks if predicate is always false' => [
            [1, 2, 3], fn() => false, [[1], [2], [3]],
        ];
        yield 'correctly chunks consecutive numbers' => [
            [1, 2, 3, 7, 8, 9, 4, 5, 6],
            fn(int $n, array $chunk) => end($chunk) === $n - 1,
            [[1, 2, 3], [7, 8, 9], [4, 5, 6]],
        ];
    }

    /**
     * @dataProvider consecutiveProvider
     */
    public function testConsecutive(iterable $col, int $size, array $expected): void
    {
        $it = Iter::consecutive($col, $size);
        Assert::assertEquals($expected, iterator_to_array($it));
    }

    public function consecutiveProvider(): iterable
    {
        yield 'collection size is a multiple of size' => [
            [1, 2, 3, 4, 5, 6, 7, 8, 9],
            3,
            [
                [1, 2, 3],
                [2, 3, 4],
                [3, 4, 5],
                [4, 5, 6],
                [5, 6, 7],
                [6, 7, 8],
                [7, 8, 9],
            ],
        ];
        yield 'collection size is NOT a multiple of size' => [
            [1, 2, 3, 4, 5],
            3,
            [
                [1, 2, 3],
                [2, 3, 4],
                [3, 4, 5],
            ],
        ];
        yield 'collection size is lower than size' => [
            [1, 2],
            3,
            [],
        ];
    }
}
