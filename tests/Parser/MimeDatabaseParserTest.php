<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\Parser;

use ju1ius\XDGMime\Parser\Exception\ParseError;
use ju1ius\XDGMime\Parser\MimeDatabaseParser;
use PHPUnit\Framework\TestCase;

final class MimeDatabaseParserTest extends TestCase
{
    public function testInvalidRootNamespace(): void
    {
        $this->expectException(ParseError::class);
        $parser = new MimeDatabaseParser();
        $parser->parseXml('<mime-info xmlns="urn:foo"></mime-info>');
    }
}
