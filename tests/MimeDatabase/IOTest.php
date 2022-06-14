<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\MimeDatabase;

use ju1ius\XDGMime\MimeDatabaseInterface;
use ju1ius\XDGMime\MimeType;
use ju1ius\XDGMime\Test\MimeTypeAssert;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\TestCase;

final class IOTest extends TestCase
{
    private static MimeDatabaseInterface $db;

    public static function testUnreadableFile(): void
    {
        $path = '/unreadable.txt';
        if (is_readable($path)) {
            self::markTestSkipped("File should not be readable: {$path}");
        }

        $type = self::getDatabase()->guessType($path);
        MimeTypeAssert::equals(MimeType::defaultText(), $type);

        $type = self::getDatabase()->guessTypeByContents($path);
        MimeTypeAssert::equals(MimeType::unknown(), $type);
    }

    private static function getDatabase(): MimeDatabaseInterface
    {
        return self::$db ??= TestDatabaseFactory::createFromString(<<<'XML'
        <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
            <mime-type type="text/plain">
                <glob pattern="*.txt"/>
            </mime-type>
        </mime-info>
        XML);
    }
}
