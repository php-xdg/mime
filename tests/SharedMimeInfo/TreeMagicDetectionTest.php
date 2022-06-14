<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

use ju1ius\XDGMime\Test\ResourceHelper;
use PHPUnit\Framework\TestCase;

final class TreeMagicDetectionTest extends TestCase
{
    /**
     * @dataProvider detectionProvider
     */
    public function testDetection(TreeMagicTestDTO $dto): void
    {
        self::markTestIncomplete('Tree magic detection not implemented');
    }

    public function detectionProvider(): \Traversable
    {
        $parser = new TreeMagicListParser();
        foreach ($parser->parse(self::getTestList()) as $dto) {
            if ($dto->xFail) {
                continue;
            }
            yield (string)$dto => [$dto];
        }
    }

    private static function getTestList(): string
    {
        return ResourceHelper::getSharedMimeInfoPath('tests/mime-detection/tree-list');
    }
}
