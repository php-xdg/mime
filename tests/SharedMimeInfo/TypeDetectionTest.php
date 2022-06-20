<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\SharedMimeInfo;

use ju1ius\XdgMime\MimeDatabaseInterface;
use ju1ius\XdgMime\Test\MimeTypeAssert;
use ju1ius\XdgMime\Test\ResourceHelper;
use ju1ius\XdgMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\TestCase;

final class TypeDetectionTest extends TestCase
{
    /**
     * Magic number retrieved by just looking at the compiled database.
     * Remember to update this when the default database is recompiled.
     */
    private const LOOKUP_BUFFER_LENGTH = 18729;

    /**
     * @dataProvider guessTypeByFilenameProvider
     */
    public function testGuessTypeByFilename(TypeDetectionTestDTO $dto): void
    {
        $type = self::getDatabase()->guessTypeByFileName($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeByFilenameProvider(): iterable
    {
        $parser = new TypeDetectionTestListParser();
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
    public function testGuessTypeByContents(TypeDetectionTestDTO $dto): void
    {
        $db = self::getDatabase();
        MimeTypeAssert::equals($dto->expectedType, $db->guessTypeByContents($dto->filename));
        $buffer = file_get_contents($dto->filename, false, null, 0, self::LOOKUP_BUFFER_LENGTH);
        MimeTypeAssert::equals($dto->expectedType, $db->guessTypeByData($buffer));
    }

    public function guessTypeByContentsProvider(): iterable
    {
        $parser = new TypeDetectionTestListParser();
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
    public function testGuessType(TypeDetectionTestDTO $dto): void
    {
        $type = self::getDatabase()->guessType($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public function guessTypeProvider(): iterable
    {
        $parser = new TypeDetectionTestListParser();
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
        return TestDatabaseFactory::default();
    }
}
