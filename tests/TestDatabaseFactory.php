<?php declare(strict_types=1);

namespace Xdg\Mime\Tests;

use Xdg\Mime\Compiler\MimeDatabaseCompiler;
use Xdg\Mime\MimeDatabaseGenerator;
use Xdg\Mime\Parser\MimeDatabaseParser;
use Xdg\Mime\Runtime\MimeDatabase;
use Xdg\Mime\XdgMimeDatabase;

final class TestDatabaseFactory
{
    private static ?XdgMimeDatabase $defaultDb = null;
    private static ?XdgMimeDatabase $defaultUnoptimizedDb = null;

    public static function default(bool $optimized = true): XdgMimeDatabase
    {
        if ($optimized) {
            return self::$defaultDb ??= new XdgMimeDatabase();
        }
        return self::$defaultUnoptimizedDb ??= self::createDefaultUnoptimized();
    }

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

    private static function createDefaultUnoptimized(): XdgMimeDatabase
    {
        $outputDir = ResourceHelper::getPath('tmp/db_deopt');
        $gen = (new MimeDatabaseGenerator())
            ->disableOptimizations()
            ->useXdgDirectories(false)
            ->addCustomPaths(ResourceHelper::getSharedMimeInfoPath('data/freedesktop.org.xml.in'))
        ;
        $gen->generate($outputDir);

        return new XdgMimeDatabase($outputDir);
    }
}
