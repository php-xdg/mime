<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

use ju1ius\XDGMime\MimeDatabaseInterface;
use ju1ius\XDGMime\Test\MimeTypeAssert;
use ju1ius\XDGMime\Test\ResourceHelper;
use ju1ius\XDGMime\XdgMimeDatabase;
use PHPUnit\Framework\TestCase;

final class TypeDetectionTest extends TestCase
{
    private static ?MimeDatabaseInterface $db = null;

    /**
     * @dataProvider guessTypeByFilenameProvider
     */
    public function testGuessTypeByFilename(TestDTO $dto): void
    {
        $type = self::getDatabase()->guessTypeByFileName($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeByFilenameProvider(): iterable
    {
        $parser = new TestListParser();
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
    public function testGuessTypeByContents(TestDTO $dto): void
    {
        $type = self::getDatabase()->guessTypeByContents($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeByContentsProvider(): iterable
    {
        $parser = new TestListParser();
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
    public function testGuessType(TestDTO $dto): void
    {
        $type = self::getDatabase()->guessType($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeProvider(): iterable
    {
        $parser = new TestListParser();
        foreach ($parser->parse(self::getTestList()) as $dto) {
            if ($dto->fullLookupXFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    private static function getTestList(): string
    {
        return ResourceHelper::getSharedMimeInfoPath('tests/mime-detection/list');
    }

    private static function getDatabase(): MimeDatabaseInterface
    {
        return self::$db ??= new XdgMimeDatabase();
    }
}
