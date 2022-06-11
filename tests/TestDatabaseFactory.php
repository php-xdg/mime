<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test;

use ju1ius\XDGMime\Compiler\MimeDatabaseCompiler;
use ju1ius\XDGMime\MimeDatabase;
use ju1ius\XDGMime\Parser\MimeDatabaseParser;

final class TestDatabaseFactory
{
    public static function createFromString(string ...$documents): MimeDatabase
    {
        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $code = $compiler->compileToString($parser->parseXml(...$documents));
        return eval($code);
    }

    public static function createFromFile(string ...$files): MimeDatabase
    {
        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $code = $compiler->compileToString($parser->parse(...$files));
        return eval($code);
    }
}
