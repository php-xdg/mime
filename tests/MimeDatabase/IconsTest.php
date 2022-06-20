<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\MimeDatabase;

use ju1ius\XdgMime\MimeDatabaseInterface;
use ju1ius\XdgMime\MimeType;
use ju1ius\XdgMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class IconsTest extends TestCase
{
    private static ?MimeDatabaseInterface $db = null;

    public function testDefaultDatabase(): void
    {
        $db = TestDatabaseFactory::default();
        Assert::assertSame('application-x-php', $db->getIconName(MimeType::of('application/x-php')));
        Assert::assertSame('text-x-script', $db->getGenericIconName(MimeType::of('application/x-php')));
    }

    public function testGetIcon(): void
    {
        Assert::assertSame('application-foo-bar', self::getDatabase()->getIconName(MimeType::of('foo/bar')));
    }

    public function testGetGenericIcon(): void
    {
        Assert::assertSame('text-x-generic', self::getDatabase()->getGenericIconName(MimeType::of('foo/bar')));
    }

    /**
     * @dataProvider notFoundIconsProvider
     */
    public function testNotFoundIcons(string $type, string $expected): void
    {
        Assert::assertSame($expected, self::getDatabase()->getIconName(MimeType::of($type)));
    }

    public function notFoundIconsProvider(): iterable
    {
        yield ['unknown/foo', 'unknown-foo'];
        yield ['application/vnd.unknown+foo', 'application-vnd.unknown+foo'];
    }

    /**
     * @dataProvider notFoundGenericIconsProvider
     */
    public function testNotFoundGenericIcons(string $type, string $expected): void
    {
        Assert::assertSame($expected, self::getDatabase()->getGenericIconName(MimeType::of($type)));
    }

    public function notFoundGenericIconsProvider(): iterable
    {
        yield ['unknown/foo', 'unknown-x-generic'];
        yield ['application/vnd.foo+bar', 'application-x-generic'];
    }

    private function getDatabase(): MimeDatabaseInterface
    {
        return self::$db ??= TestDatabaseFactory::createFromString(<<<'XML'
        <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
            <mime-type type="foo/bar">
                <icon name="application-foo-bar"/>
                <generic-icon name="text-x-generic"/>
            </mime-type>
        </mime-info>
        XML);
    }
}
