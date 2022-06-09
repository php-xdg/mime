<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\SharedMimeInfo;

use ju1ius\XDGMime\Test\SharedMimeInfo\Utils\SharedMimeInfoTestDTO;
use ju1ius\XDGMime\Test\SharedMimeInfo\Utils\SharedMimeInfoTestFileParser;
use PHPUnit\Framework\TestCase;

final class TypeDetectionTest extends TestCase
{
    private const RESOURCE_PATH = __DIR__ . '/../Resources/shared-mime-info/tests/mime-detection';

    /**
     * @dataProvider typeDetectionProvider
     */
    public function testTypeDetection(SharedMimeInfoTestDTO $dto): void
    {
        self::markTestIncomplete('Not implemented');
    }

    public function typeDetectionProvider(): iterable
    {
        $parser = new SharedMimeInfoTestFileParser();
        foreach ($parser->parse(self::RESOURCE_PATH . '/list') as $dto) {
            yield (string)$dto => [$dto];
        }
    }
}
