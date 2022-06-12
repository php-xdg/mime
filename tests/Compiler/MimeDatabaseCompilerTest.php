<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\Compiler;

use ju1ius\XDGMime\Compiler\MimeDatabaseCompiler;
use ju1ius\XDGMime\Parser\MimeDatabaseParser;
use ju1ius\XDGMime\Runtime\AliasesDatabase;
use ju1ius\XDGMime\Runtime\GlobsDatabase;
use ju1ius\XDGMime\Runtime\MagicDatabase;
use ju1ius\XDGMime\Runtime\MimeDatabase;
use ju1ius\XDGMime\Runtime\SubclassesDatabase;
use ju1ius\XDGMime\Test\ResourceHelper;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class MimeDatabaseCompilerTest extends TestCase
{
    public function testItCompilesDefaultDatabase(): void
    {
        $db = TestDatabaseFactory::createFromFile(
            ResourceHelper::getSharedMimeInfoPath('data/freedesktop.org.xml.in')
        );
        Assert::assertInstanceOf(MimeDatabase::class, $db);
    }

    public function testItCompilesDefaultDatabaseToSingleFile(): void
    {
        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $path = ResourceHelper::getPath('tmp/database.php');
        $compiler->compileToFile(
            $parser->parse(self::getXmlDatabasePath()),
            $path,
        );
        $this->assertIncludeInstanceOf($path, MimeDatabase::class);
    }

    public function testItCompilesDefaultDatabaseToDirectory(): void
    {
        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $path = ResourceHelper::getPath('tmp/db');
        $compiler->compileToDirectory(
            $parser->parse(self::getXmlDatabasePath()),
            $path,
        );
        $this->assertIncludeInstanceOf("{$path}/aliases.php", AliasesDatabase::class);
        $this->assertIncludeInstanceOf("{$path}/subclasses.php", SubclassesDatabase::class);
        $this->assertIncludeInstanceOf("{$path}/globs.php", GlobsDatabase::class);
        $this->assertIncludeInstanceOf("{$path}/magic.php", MagicDatabase::class);
    }

    private function assertIncludeInstanceOf(string $path, string $class): void
    {
        try {
            $subject = include $path;
        } finally {
            @unlink($path);
        }
        Assert::assertInstanceOf($class, $subject);
    }

    private static function getXmlDatabasePath(): string
    {
        return ResourceHelper::getSharedMimeInfoPath('data/freedesktop.org.xml.in');
    }
}
