<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\MimeDatabase;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\MimeDatabaseInterface;
use Xdg\Mime\MimeType;
use Xdg\Mime\Tests\MimeTypeAssert;
use Xdg\Mime\Tests\TestDatabaseFactory;

final class CanonicalTypeTest extends TestCase
{
    public function testGetCanonicalType(): void
    {
        $xml = <<<'XML'
        <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
            <mime-type type="application/x-foo">
                <alias type="text/x-foo"/>
                <alias type="application/x-foobar"/>
            </mime-type>
        </mime-info>
        XML;
        $db = TestDatabaseFactory::createFromString($xml);
        $appFoo = MimeType::of('application/x-foo');
        $textFoo = MimeType::of('text/x-foo');
        Assert::assertSame($appFoo, $db->getCanonicalType($appFoo));
        Assert::assertSame($appFoo, $db->getCanonicalType($textFoo));
    }

    /**
     * @dataProvider defaultAliasProvider
     */
    public function testWithDefaultDatabase(string $alias, string $expected): void
    {
        $type = self::getDatabase()->getCanonicalType(MimeType::of($alias));
        MimeTypeAssert::equals($expected, $type);
    }

    public function defaultAliasProvider(): \Traversable
    {
        yield ['application/javascript', 'text/javascript'];
        yield ['application/x-javascript', 'text/javascript'];
    }

    private static function getDatabase(): MimeDatabaseInterface
    {
        return TestDatabaseFactory::default();
    }
}
