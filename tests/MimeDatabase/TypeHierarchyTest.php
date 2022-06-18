<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\MimeDatabase;

use ju1ius\XdgMime\MimeDatabaseInterface;
use ju1ius\XdgMime\MimeType;
use ju1ius\XdgMime\Test\TestDatabaseFactory;
use ju1ius\XdgMime\XdgMimeDatabase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class TypeHierarchyTest extends TestCase
{
    private static ?MimeDatabaseInterface $db = null;

    /**
     * @dataProvider getAncestorsProvider
     */
    public function testGetAncestors(MimeDatabaseInterface $db, string $input, array $expected): void
    {
        $ancestors = $db->getAncestors(MimeType::of($input));
        Assert::assertSame(self::toMimeTypes($expected), $ancestors);
    }

    public function getAncestorsProvider(): \Traversable
    {
        $db = TestDatabaseFactory::createFromString(<<<'XML'
        <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
            <mime-type type="text/x-foobar">
                <sub-class-of type="text/plain"/>
            </mime-type>
            <mime-type type="text/x-foo">
                <sub-class-of type="text/x-foobar"/>
            </mime-type>
            <mime-type type="text/x-bar">
                <sub-class-of type="text/x-foobar"/>
                <sub-class-of type="text/x-baz"/>
                <alias type="application/x-bar"/>
            </mime-type>
        </mime-info>
        XML);

        yield 'single inheritance' => [
            $db,
            'text/x-foo',
            ['text/x-foobar', 'text/plain'],
        ];
        yield 'multiple inheritance' => [
            $db,
            'text/x-bar',
            ['text/x-foobar', 'text/plain', 'text/x-baz'],
        ];
        yield 'aliases are resolved' => [
            $db,
            'application/x-bar',
            ['text/x-foobar', 'text/plain', 'text/x-baz'],
        ];
    }

    /**
     * @dataProvider defaultAncestorsProvider
     */
    public function testWithDefaultDatabase(string $input, array $expected): void
    {
        $ancestors = self::getDatabase()->getAncestors(MimeType::of($input));
        Assert::assertSame(self::toMimeTypes($expected), $ancestors);
    }

    public function defaultAncestorsProvider(): \Traversable
    {
        yield 'application/json' => [
            'application/json',
            ['text/javascript', 'application/ecmascript', 'application/x-executable', 'text/plain'],
        ];
    }

    /**
     * @param array<string|MimeType> $types
     * @return array<MimeType>
     */
    private static function toMimeTypes(array $types): array
    {
        return array_map(MimeType::of(...), $types);
    }

    private static function getDatabase(): MimeDatabaseInterface
    {
        return self::$db ??= new XdgMimeDatabase();
    }
}
