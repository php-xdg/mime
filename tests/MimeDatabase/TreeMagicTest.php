<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\MimeDatabase;

use ju1ius\XDGMime\MimeDatabaseInterface;
use ju1ius\XDGMime\Test\MimeTypeAssert;
use ju1ius\XDGMime\Test\ResourceHelper;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

final class TreeMagicTest extends TestCase
{
    private static ?MimeDatabaseInterface $db = null;

    private const REQUIRED_DIRS = [
        'x-content-failure/nope/empty',
    ];

    /**
     * @beforeClass
     */
    public static function createRequiredDirectories(): void
    {
        $fs = new Filesystem();
        foreach (self::REQUIRED_DIRS as $dir) {
            $fs->mkdir(ResourceHelper::getTreePath($dir), 0o755);
        }
    }

    /**
     * @dataProvider guessTypeProvider
     */
    public function testGuessType(string $rootPath, string $expected): void
    {
        $type = self::getDatabase()->guessTypeForTree(ResourceHelper::getTreePath($rootPath));
        MimeTypeAssert::equals($expected, $type);
    }

    public function guessTypeProvider(): \Traversable
    {
        yield ['matches-nothing', 'inode/directory'];
        yield ['x-content-foo', 'x-content/foo'];
        yield ['x-content-bar', 'x-content/bar'];
        yield ['x-content-failure', 'inode/directory'];
    }

    private static function getDatabase(): MimeDatabaseInterface
    {
        return self::$db ??= TestDatabaseFactory::createFromFile(
            ResourceHelper::getTreePath('mime-info.xml')
        );
    }
}
