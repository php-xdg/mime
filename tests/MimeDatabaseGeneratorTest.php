<?php declare(strict_types=1);

namespace Xdg\Mime\Tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Xdg\Mime\MimeDatabaseGenerator;
use Xdg\Mime\Runtime\AliasesDatabase;
use Xdg\Mime\Runtime\GlobsDatabase;
use Xdg\Mime\Runtime\MagicDatabase;
use Xdg\Mime\Runtime\SubclassesDatabase;
use Xdg\Mime\Runtime\TreeMagicDatabase;
use Xdg\Mime\Runtime\XmlNamespacesDatabase;

final class MimeDatabaseGeneratorTest extends TestCase
{
    public function testNew(): void
    {
        Assert::assertInstanceOf(MimeDatabaseGenerator::class, MimeDatabaseGenerator::new());
    }

    public function testGeneratesThrowsIfNoFilesWereFound(): void
    {
        $this->expectException(\LengthException::class);
        $generator = (new MimeDatabaseGenerator())
            ->useXdgDirectories(false)
            ->addCustomPaths();
        $generator->generate(ResourceHelper::getPath('tmp/db'));
    }

    private const FILES_MAP = [
        AliasesDatabase::class => 'aliases',
        SubclassesDatabase::class => 'subclasses',
        GlobsDatabase::class => 'globs',
        MagicDatabase::class => 'magic',
        TreeMagicDatabase::class => 'treemagic',
        XmlNamespacesDatabase::class => 'namespaces',
    ];

    /**
     * @backupGlobals enabled
     * @dataProvider generateProvider
     */
    public function testGenerate(MimeDatabaseGenerator $generator, array $env = []): void
    {
        // populates ENV
        foreach ($env as $key => $value) {
            $_ENV[$key] = $value;
        }
        // clean output directory
        $outputDir = ResourceHelper::getPath('tmp/db');
        $fs = new Filesystem();
        $fs->remove($outputDir);
        Assert::assertDirectoryDoesNotExist($outputDir);
        // generate database
        $generator
            ->enablePlatformDependentOptimizations()
            ->generate($outputDir);
        Assert::assertDirectoryExists($outputDir);
        foreach (self::FILES_MAP as $class => $file) {
            Assert::assertInstanceOf($class, include "{$outputDir}/{$file}.php");
        }
    }

    public function generateProvider(): \Traversable
    {
        yield 'custom paths' => [
            MimeDatabaseGenerator::new()
                ->useXdgDirectories(false)
                ->addCustomPaths(ResourceHelper::getFilePath('empty-mime-info.xml')),
        ];
        $dataDir = ResourceHelper::getFilePath('empty-data-dir');
        yield 'xdg data dir' => [
            MimeDatabaseGenerator::new()
                ->useXdgDirectories()
                ->addCustomPaths($dataDir),
            ['XDG_DATA_HOME' => $dataDir, 'XDG_DATA_DIRS' => $dataDir],
        ];
    }
}
