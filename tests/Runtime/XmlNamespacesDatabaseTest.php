<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Runtime;

use ju1ius\XdgMime\Runtime\XmlNamespacesDatabase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class XmlNamespacesDatabaseTest extends TestCase
{
    private static XmlNamespacesDatabase $db;

    private static function getDatabase(): XmlNamespacesDatabase
    {
        return self::$db ??= new XmlNamespacesDatabase([
            'urn:foo' => ['foo' => 'application/x-foo+xml'],
            'urn:foobar' => [
                'foo' => 'application/x-foo+bar',
                'bar' => 'application/x-bar+foo',
                'foobar' => 'application/x-foobar',
            ],
            'urn:qux' => ['' => 'application/x-qux'],
        ]);
    }

    /**
     * @dataProvider getProvider
     */
    public function testGet(string $namespace, string $localName, ?string $expected): void
    {
        Assert::assertSame($expected, self::getDatabase()->get($namespace, $localName));
    }

    public function getProvider(): iterable
    {
        yield ['urn:nope', 'nope', null];
        yield ['urn:foo', 'foo', 'application/x-foo+xml'];
        yield ['urn:qux', '666', 'application/x-qux'];
    }

    /**
     * @dataProvider matchDataProvider
     */
    public function testMatchData(string $input, ?string $expected): void
    {
        Assert::assertSame($expected, self::getDatabase()->matchData($input));
    }

    public function matchDataProvider(): iterable
    {
        yield 'start tag without namespace' => [
            '<foo>',
            null,
        ];
        yield 'start tag with namespace' => [
            '<foo xmlns="urn:foo">',
            'application/x-foo+xml',
        ];
        yield 'start tag disambiguation #1' => [
            '<foo xmlns="urn:foobar">',
            'application/x-foo+bar',
        ];
        yield 'start tag disambiguation #2' => [
            '<bar xmlns="urn:foobar">',
            'application/x-bar+foo',
        ];
        yield 'it skips anything before first tag' => [
            <<<'XML'
            <!DOCTYPE foobar>
            <!-- <foo xmlns="urn:foo"/> -->
            <foobar xmlns="urn:foobar">
            XML,
            'application/x-foobar',
        ];
        yield 'tag name wildcard' => [
            '<a xmlns="urn:qux">',
            'application/x-qux',
        ];
    }

    /**
     * @dataProvider matchDomDocumentProvider
     */
    public function testMatchDomDocument(string $input, ?string $expected): void
    {
        $doc = new \DOMDocument();
        $doc->loadXML($input);
        Assert::assertSame($expected, self::getDatabase()->matchDomDocument($doc));
    }

    public function matchDomDocumentProvider(): iterable
    {
        yield 'no namespace' => [
            '<foo />',
            null,
        ];
        yield 'with namespace' => [
            '<foo xmlns="urn:foo" />',
            'application/x-foo+xml',
        ];
        yield 'localName disambiguation #1' => [
            '<foo xmlns="urn:foobar" />',
            'application/x-foo+bar',
        ];
        yield 'localName disambiguation #2' => [
            '<bar xmlns="urn:foobar"/>',
            'application/x-bar+foo',
        ];
        yield 'localName wildcard' => [
            '<whatever xmlns="urn:qux"/>',
            'application/x-qux',
        ];
    }
}
