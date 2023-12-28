<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\SharedMimeInfo;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\MimeDatabaseInterface;
use Xdg\Mime\Tests\MimeTypeAssert;
use Xdg\Mime\Tests\ResourceHelper;
use Xdg\Mime\Tests\TestDatabaseFactory;

final class TypeDetectionTest extends TestCase
{
    /**
     * Magic number retrieved by just looking at the compiled database.
     * Remember to update this when the default database is recompiled.
     */
    private const LOOKUP_BUFFER_LENGTH = 18730;

    #[DataProvider('guessTypeByFilenameProvider')]
    public function testGuessTypeByFilename(TypeDetectionTestDTO $dto): void
    {
        $type = self::getDatabase()->guessTypeByFileName($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    #[DataProvider('guessTypeByFilenameProvider')]
    public function testGuessTypeByFilenameUnoptimized(TypeDetectionTestDTO $dto): void
    {
        $type = self::getDatabase(false)->guessTypeByFileName($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public static function guessTypeByFilenameProvider(): iterable
    {
        $parser = new TypeDetectionTestListParser(ResourceHelper::getSharedMimeInfoPath('tests/mime-detection'));
        foreach ($parser->parse(self::getTestList()) as $dto) {
            if ($dto->filenameLookupXFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    #[DataProvider('guessTypeByContentsProvider')]
    public function testGuessTypeByContents(TypeDetectionTestDTO $dto): void
    {
        $db = self::getDatabase();
        MimeTypeAssert::equals($dto->expectedType, $db->guessTypeByContents($dto->filename));
        $buffer = file_get_contents($dto->filename, false, null, 0, self::LOOKUP_BUFFER_LENGTH);
        MimeTypeAssert::equals($dto->expectedType, $db->guessTypeByData($buffer));
    }

    #[DataProvider('guessTypeByContentsProvider')]
    public function testGuessTypeByContentsUnoptimized(TypeDetectionTestDTO $dto): void
    {
        $db = self::getDatabase(false);
        MimeTypeAssert::equals($dto->expectedType, $db->guessTypeByContents($dto->filename));
        $buffer = file_get_contents($dto->filename, false, null, 0, self::LOOKUP_BUFFER_LENGTH);
        MimeTypeAssert::equals($dto->expectedType, $db->guessTypeByData($buffer));
    }

    public static function guessTypeByContentsProvider(): iterable
    {
        $parser = new TypeDetectionTestListParser(ResourceHelper::getSharedMimeInfoPath('tests/mime-detection'));
        foreach ($parser->parse(self::getTestList()) as $dto) {
            if ($dto->magicLookupXFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    #[DataProvider('guessTypeProvider')]
    public function testGuessType(TypeDetectionTestDTO $dto): void
    {
        $type = self::getDatabase()->guessType($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    #[DataProvider('guessTypeProvider')]
    public function testGuessTypeUnoptimized(TypeDetectionTestDTO $dto): void
    {
        $type = self::getDatabase(false)->guessType($dto->filename);
        MimeTypeAssert::equals($dto->expectedType, $type);
    }

    public static function guessTypeProvider(): iterable
    {
        $parser = new TypeDetectionTestListParser(ResourceHelper::getSharedMimeInfoPath('tests/mime-detection'));
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

    private static function getDatabase(bool $optimized = true): MimeDatabaseInterface
    {
        return TestDatabaseFactory::default($optimized);
    }
}
