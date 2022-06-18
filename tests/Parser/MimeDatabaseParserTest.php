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
}
