<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Parser;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Parser\Exception\ParseError;
use Xdg\Mime\Parser\Validator\MimeInfoRngValidator;
use Xdg\Mime\Parser\Validator\MimeInfoXsdValidator;

final class ValidatorTest extends TestCase
{
    private const XML_TPL = <<<'XML'
    <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
    %s
    </mime-info>
    XML;

    #[DataProvider('parseErrorsProvider')]
    public function testXsdValidator(string $xml, bool $xFail = false): void
    {
        if ($xFail) {
            self::markTestSkipped('XSD does not support this constraint.');
        }
        $this->expectException(ParseError::class);
        $validator = new MimeInfoXsdValidator();
        $validator->validate(self::createDocument($xml));
    }

    #[DataProvider('parseErrorsProvider')]
    public function testRngValidator(string $xml): void
    {
        $this->expectException(ParseError::class);
        $validator = new MimeInfoRngValidator();
        $validator->validate(self::createDocument($xml));
    }

    public static function parseErrorsProvider(): \Traversable
    {
        yield 'invalid <mime-type type/>' => [
            '<mime-type type="foo/bar/baz" />',
        ];
        yield 'invalid <alias type/>' => [
            '<mime-type type="a/b"><alias type="b/c/d"/></mime-type>',
        ];
        yield 'invalid <sub-class-of type/>' => [
            '<mime-type type="a/b"><sub-class-of type="b/c/d"/></mime-type>',
        ];
        yield 'multiple <icon/>' => [
            '<mime-type type="a/b"><icon name="a"/><icon name="b"/></mime-type>',
            true,
        ];
        yield 'multiple <generic-icon/>' => [
            '<mime-type type="a/b"><generic-icon name="a"/><generic-icon name="b"/></mime-type>',
            true,
        ];
        yield 'multiple <glob-deleteall/>' => [
            '<mime-type type="a/b"><glob-deleteall/><glob-deleteall/></mime-type>',
            true,
        ];
        yield 'multiple <magic-deleteall/>' => [
            '<mime-type type="a/b"><magic-deleteall/><magic-deleteall/></mime-type>',
            true,
        ];
        yield 'invalid <glob pattern/>' => [
            '<mime-type type="a/b"><glob pattern=""/></mime-type>',
        ];
        yield 'invalid <glob weight/>' => [
            '<mime-type type="a/b"><glob pattern="*.c" weight="-1"/></mime-type>',
        ];
        yield 'invalid <glob case-sensitive/>' => [
            '<mime-type type="a/b"><glob pattern="*.c" case-sensitive="0"/></mime-type>',
        ];
        yield 'invalid <match type>' => [
            '<mime-type type="a/b"><magic><match type="foo" offset="0" value="0x0"/></magic></mime-type>',
        ];
        yield 'empty string <match value>' => [
            '<mime-type type="a/b"><magic><match type="string" offset="0" value=""/></magic></mime-type>',
        ];
        yield 'invalid integer <match value>' => [
            '<mime-type type="a/b"><magic><match type="byte" offset="0" value="Z"/></magic></mime-type>',
            true,
        ];
        yield 'invalid string <match mask>' => [
            <<<'XML'
            <mime-type type="a/b">
                <magic>
                    <match type="string" offset="0" value="a" mask="0" />
                </magic>
            </mime-type>
            XML,
            true,
        ];
        yield 'invalid <treematch type>' => [
            '<mime-type type="a/b"><treemagic><treematch type="foo" path="bar"/></treemagic></mime-type>',
        ];
    }

    private static function createDocument(string $xml): \DOMDocument
    {
        $doc = new \DOMDocument();
        $doc->loadXML(sprintf(self::XML_TPL, $xml));
        return $doc;
    }
}
