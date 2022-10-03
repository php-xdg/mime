<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\MimeDatabase;

use PHPUnit\Framework\TestCase;
use Xdg\Mime\Tests\MimeTypeAssert;
use Xdg\Mime\Tests\TestDatabaseFactory;

final class XmlNamespaceTest extends TestCase
{
    /**
     * @dataProvider guessTypeProvider
     */
    public function testGuessTypeForXml(string $data, string $expected): void
    {
        $db = TestDatabaseFactory::default();
        MimeTypeAssert::equals($expected, $db->guessTypeForXml($data));
    }

    /**
     * @dataProvider guessTypeProvider
     */
    public function testGuessTypeForDomDocument(string $data, string $expected): void
    {
        $db = TestDatabaseFactory::default();
        $doc = new \DOMDocument();
        $doc->loadXML($data);
        MimeTypeAssert::equals($expected, $db->guessTypeForDomDocument($doc));
    }

    public function guessTypeProvider(): iterable
    {
        yield 'failure' => [
            '<unknown />',
            'application/xml',
        ];
        yield 'atom feed' => [
            '<feed xmlns="http://www.w3.org/2005/Atom" />',
            'application/atom+xml',
        ];
        yield 'OWL' => [
            '<Ontology xmlns="http://www.w3.org/2002/07/owl#" />',
            'application/owl+xml',
        ];
        yield 'MathML' => [
            '<math xmlns="http://www.w3.org/1998/Math/MathML" />',
            'application/mathml+xml',
        ];
        yield 'SVG' => [
            '<svg xmlns="http://www.w3.org/2000/svg" />',
            'image/svg+xml',
        ];
    }
}
