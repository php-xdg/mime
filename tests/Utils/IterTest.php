<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Utils;

use ju1ius\XdgMime\Utils\Iter;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class IterTest extends TestCase
{
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
