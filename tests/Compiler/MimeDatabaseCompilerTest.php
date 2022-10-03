<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Compiler;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Compiler\MimeDatabaseCompiler;
use Xdg\Mime\Parser\MimeDatabaseParser;
use Xdg\Mime\Runtime\AliasesDatabase;
use Xdg\Mime\Runtime\GlobsDatabase;
use Xdg\Mime\Runtime\MagicDatabase;
use Xdg\Mime\Runtime\MimeDatabase;
use Xdg\Mime\Runtime\SubclassesDatabase;
use Xdg\Mime\Tests\ResourceHelper;
use Xdg\Mime\Tests\TestDatabaseFactory;

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
