<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\MimeDatabase;

use ju1ius\XDGMime\MimeDatabase;
use ju1ius\XDGMime\MimeType;
use ju1ius\XDGMime\Test\MimeTypeAssert;
use ju1ius\XDGMime\Test\ResourceHelper;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\TestCase;

final class InodeGuessingTest extends TestCase
{
    private static MimeDatabase $db;

    public function testGuessDirectory(): void
    {
        $type = self::getDatabase()->guessType(__DIR__);
        MimeTypeAssert::equals(MimeType::directory(), $type);
    }

    public function testGuessInodeCharDevice(): void
    {
        if (!file_exists('/dev/null')) {
            self::markTestSkipped('/dev/null not found on this platform.');
        }
        $type = self::getDatabase()->guessType('/dev/null');
        MimeTypeAssert::equals(MimeType::characterDevice(), $type);
    }

    public function testGuessInodeFifo(): void
    {
        $path = ResourceHelper::getFilePath('fifo');
        if (!posix_mkfifo($path, 0o777)) {
            self::markTestSkipped(sprintf(
                'Could not create FIFO: "%s"',
                $path,
            ));
        }
        try {
            $type = self::getDatabase()->guessType($path);
        } finally {
            unlink($path);
        }
        MimeTypeAssert::equals(MimeType::fifo(), $type);
    }

    public static function testGuessInodeSocket(): void
    {
        $path = ResourceHelper::getFilePath('socket');
        $socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!$socket) {
            self::markTestSkipped('Could not create socket.');
        }
        if (!socket_bind($socket, $path)) {
            self::markTestSkipped(sprintf(
                'Could not bind socket to "%s"',
                $path,
            ));
        }
        try {
            $type = self::getDatabase()->guessType($path);
        } finally {
            socket_close($socket);
            unlink($path);
        }
        MimeTypeAssert::equals(MimeType::socket(), $type);
    }

    private static function getDatabase(): MimeDatabase
    {
        return self::$db ??= TestDatabaseFactory::createFromString(
            '<mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info"></mime-info>'
        );
    }
}
