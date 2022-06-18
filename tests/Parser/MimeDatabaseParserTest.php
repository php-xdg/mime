<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Parser;

use ju1ius\XdgMime\Parser\Exception\ParseError;
use ju1ius\XdgMime\Parser\MimeDatabaseParser;
use PHPUnit\Framework\TestCase;

final class MimeDatabaseParserTest extends TestCase
{
    public function testInvalidRootNamespace(): void
    {
        $this->expectException(ParseError::class);
        $parser = new MimeDatabaseParser();
        $parser->parseXml('<mime-info xmlns="urn:foo"></mime-info>');
    }

    public function testInvalidRange(): void
    {
        $this->expectException(ParseError::class);
        $parser = new MimeDatabaseParser();
        $parser->parseXml(<<<'XML'
        <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
            <mime-type type="a/b">
                <magic>
                    <match type="string" offset="64:63" value="foo"/>
                </magic>
            </mime-type>
        </mime-info>
        XML);
    }

    /**
     * @dataProvider invalidStringMaskProvider
     */
    public function testInvalidStringMask(string $input): void
    {
        $this->expectException(ParseError::class);
        $parser = new MimeDatabaseParser();
        $xml = sprintf(
            <<<'XML'
            <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
                <mime-type type="a/b">
                    <magic>%s</magic>
                </mime-type>
            </mime-info>
            XML,
            $input,
        );
        $parser->parseXml($xml);
    }

    public function invalidStringMaskProvider(): iterable
    {
        yield 'mask shorter than value' => [
            '<match type="string" offset="0" value="foo" mask="0x00"/>',
        ];
        yield 'mask longer than value' => [
            '<match type="string" offset="0" value="a" mask="0x00FF"/>',
        ];
    }
}
