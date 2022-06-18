<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test;

use ju1ius\XdgMime\Compiler\MimeDatabaseCompiler;
use ju1ius\XdgMime\Parser\MimeDatabaseParser;
use ju1ius\XdgMime\Runtime\MimeDatabase;

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
