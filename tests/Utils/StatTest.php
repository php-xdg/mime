<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Utils;

use ju1ius\XdgMime\Exception\IOError;
use ju1ius\XdgMime\Utils\Stat;
use PHPUnit\Framework\TestCase;

final class StatTest extends TestCase
{
    public function testItThrowsIOError(): void
    {
        $this->expectException(IOError::class);
        Stat::of('/<nope>');
    }
}
