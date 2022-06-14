<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\Utils;

use ju1ius\XDGMime\Exception\IOError;
use ju1ius\XDGMime\Utils\Stat;
use PHPUnit\Framework\TestCase;

final class StatTest extends TestCase
{
    public function testItThrowsIOError(): void
    {
        $this->expectException(IOError::class);
        Stat::of('/<nope>');
    }
}
