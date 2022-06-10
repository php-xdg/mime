<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

use ju1ius\XDGMime\Compiler\MimeDatabaseCompiler;
use ju1ius\XDGMime\MimeDatabase;
use ju1ius\XDGMime\Parser\MimeDatabaseParser;
use ju1ius\XDGMime\Test\MimeTypeAssert;
use ju1ius\XDGMime\Test\SharedMimeInfo\Utils\SharedMimeInfoTestDTO;
use ju1ius\XDGMime\Test\SharedMimeInfo\Utils\SharedMimeInfoTestFileParser;
use PHPUnit\Framework\TestCase;

final class TypeDetectionTest extends TestCase
{
    private const RESOURCE_PATH = __DIR__ . '/../Resources/shared-mime-info/tests/mime-detection';

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
        foreach ($parser->parse(self::RESOURCE_PATH . '/list') as $dto) {
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
        foreach ($parser->parse(self::RESOURCE_PATH . '/list') as $dto) {
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
        foreach ($parser->parse(self::RESOURCE_PATH . '/list') as $dto) {
            if ($dto->fullLookupXFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    private static function getDatabase(): MimeDatabase
    {
        if (self::$db) {
            return self::$db;
        }

        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $code = $compiler->compile($parser->parse([
            __DIR__ . '/../Resources/shared-mime-info/data/freedesktop.org.xml.in',
        ]));
        return self::$db = eval(substr($code, 5));
    }
}
