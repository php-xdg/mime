<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\SharedMimeInfo;

use ju1ius\XdgMime\MimeDatabaseInterface;
use ju1ius\XdgMime\MimeType;
use ju1ius\XdgMime\Test\ResourceHelper;
use ju1ius\XdgMime\XdgMimeDatabase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class TreeMagicDetectionTest extends TestCase
{
    private static ?MimeDatabaseInterface $db = null;

    /**
     * @fixme The tests seem to imply that the algorithm should return several MIME types.
     *
     * @dataProvider detectionProvider
     */
    public function testDetection(TreeMagicTestDTO $dto): void
    {
        $type = self::getDatabase()->guessTypeForTree($dto->path);
        $expected = array_map(MimeType::of(...), $dto->types);
        if ($dto->xFail) {
            Assert::assertNotContains($type, $expected);
        } else {
            Assert::assertContains($type, $expected);
        }
    }

    public function detectionProvider(): \Traversable
    {
        $parser = new TreeMagicListParser();
        foreach ($parser->parse(self::getTestList()) as $dto) {
            yield (string)$dto => [$dto];
        }
    }

    private static function getTestList(): string
    {
        return ResourceHelper::getSharedMimeInfoPath('tests/mime-detection/tree-list');
    }

    private static function getDatabase(): MimeDatabaseInterface
    {
        return self::$db ??= new XdgMimeDatabase();
    }
}
