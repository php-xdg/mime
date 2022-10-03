<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Utils;

use PHPUnit\Framework\TestCase;
use Xdg\Mime\Exception\IOError;
use Xdg\Mime\Utils\Stat;

final class StatTest extends TestCase
{
    public function testItThrowsIOError(): void
    {
        $this->expectException(IOError::class);
        Stat::of('/<nope>');
    }
}
