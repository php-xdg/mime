<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

use ju1ius\XDGMime\MimeDatabase;
use ju1ius\XDGMime\Test\MimeTypeAssert;
use ju1ius\XDGMime\Test\ResourceHelper;
use ju1ius\XDGMime\Test\SharedMimeInfo\Utils\SharedMimeInfoTestDTO;
use ju1ius\XDGMime\Test\SharedMimeInfo\Utils\SharedMimeInfoTestFileParser;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\TestCase;

final class TypeDetectionTest extends TestCase
{
    private static ?MimeDatabase $db = null;

    /**
     * @dataProvider guessTypeByFilenameProvider
     */
    public function testGuessTypeByFilename(SharedMimeInfoTestDTO $dto): void
    {
        $type = self::getDatabase()->guessTypeByFileName($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeByFilenameProvider(): iterable
    {
        $parser = new SharedMimeInfoTestFileParser();
        foreach ($parser->parse(self::getTestList()) as $dto) {
            if ($dto->filenameLookupXFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    /**
     * @dataProvider guessTypeByContentsProvider
     */
    public function testGuessTypeByContents(SharedMimeInfoTestDTO $dto): void
    {
        $type = self::getDatabase()->guessTypeByContents($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeByContentsProvider(): iterable
    {
        $parser = new SharedMimeInfoTestFileParser();
        foreach ($parser->parse(self::getTestList()) as $dto) {
            if ($dto->magicLookupXFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    /**
     * @dataProvider guessTypeProvider
     */
    public function testGuessType(SharedMimeInfoTestDTO $dto): void
    {
        $type = self::getDatabase()->guessType($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeProvider(): iterable
    {
        $parser = new SharedMimeInfoTestFileParser();
        foreach ($parser->parse(self::getTestList()) as $dto) {
            if ($dto->fullLookupXFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    private static function getTestList(): string
    {
        return ResourceHelper::getPath('shared-mime-info/tests/mime-detection/list');
    }

    private static function getDatabase(): MimeDatabase
    {
        return self::$db ??= TestDatabaseFactory::createFromFile(
            ResourceHelper::getPath('shared-mime-info/data/freedesktop.org.xml.in'),
        );
    }
}
