<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\SharedMimeInfo;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\MimeDatabaseInterface;
use Xdg\Mime\MimeType;
use Xdg\Mime\Tests\ResourceHelper;
use Xdg\Mime\Tests\TestDatabaseFactory;

final class TreeMagicDetectionTest extends TestCase
{
    /**
     * @fixme The tests seem to imply that the algorithm should return several MIME types.
     */
    #[DataProvider('detectionProvider')]
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

    public static function detectionProvider(): \Traversable
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
        return TestDatabaseFactory::default();
    }
}
