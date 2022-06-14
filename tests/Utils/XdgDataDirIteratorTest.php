<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\Utils;

use ju1ius\XDGMime\Utils\XdgDataDirIterator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class XdgDataDirIteratorTest extends TestCase
{
    /**
     * @dataProvider dataDirsProvider
     */
    public function testDataDirs(array $env, array $expected): void
    {
        Assert::assertSame($expected, iterator_to_array(new XdgDataDirIterator($env)));
    }

    public function dataDirsProvider(): \Traversable
    {
        yield 'empty env' => [
            [],
            ['/usr/local/share', '/usr/share'],
        ];
        yield 'HOME only' => [
            ['HOME' => '/foo'],
            ['/foo/.local/share', '/usr/local/share', '/usr/share'],
        ];
        yield 'XDG_DATA_HOME only' => [
            ['XDG_DATA_HOME' => '/foo'],
            ['/foo', '/usr/local/share', '/usr/share'],
        ];
        yield 'XDG_DATA_DIRS only' => [
            ['XDG_DATA_DIRS' => '/foo:/bar'],
            ['/foo', '/bar'],
        ];
        yield 'no XDG_DATA_DIRS' => [
            ['HOME' => '/foo', 'XDG_DATA_HOME' => '/bar'],
            ['/bar', '/usr/local/share', '/usr/share'],
        ];
        yield 'all set' => [
            ['HOME' => '/foo', 'XDG_DATA_HOME' => '/bar', 'XDG_DATA_DIRS' => '/baz:/qux'],
            ['/bar', '/baz', '/qux'],
        ];
    }
}
