<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\MimeDatabase;

use ju1ius\XDGMime\MimeDatabaseInterface;
use ju1ius\XDGMime\MimeType;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class TypeHierarchyTest extends TestCase
{
    /**
     * @dataProvider getAncestorsProvider
     */
    public function testGetAncestors(MimeDatabaseInterface $db, MimeType $input, array $expected): void
    {
        Assert::assertSame($expected, $db->getAncestors($input));
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
            </mime-type>
        </mime-info>
        XML);

        yield 'single inheritance' => [
            $db,
            MimeType::of('text/x-foo'),
            [MimeType::of('text/x-foobar'), MimeType::defaultText()],
        ];
        yield 'multiple inheritance' => [
            $db,
            MimeType::of('text/x-bar'),
            [MimeType::of('text/x-foobar'), MimeType::defaultText(), MimeType::of('text/x-baz')],
        ];
    }
}
