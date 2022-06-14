<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test;

use ju1ius\XDGMime\MimeDatabaseGenerator;
use ju1ius\XDGMime\Runtime\AliasesDatabase;
use ju1ius\XDGMime\Runtime\GlobsDatabase;
use ju1ius\XDGMime\Runtime\MagicDatabase;
use ju1ius\XDGMime\Runtime\SubclassesDatabase;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

final class MimeDatabaseGeneratorTest extends TestCase
{
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
        $generator->generate($outputDir);
        Assert::assertDirectoryExists($outputDir);
        foreach (self::FILES_MAP as $class => $file) {
            Assert::assertInstanceOf($class, include "{$outputDir}/{$file}.php");
        }
    }

    public function generateProvider(): \Traversable
    {
        yield 'custom paths' => [
            (new MimeDatabaseGenerator())
                ->useXdgDirectories(false)
                ->addCustomPaths(ResourceHelper::getFilePath('empty-mime-info.xml')),
        ];
        $dataDir = ResourceHelper::getFilePath('empty-data-dir');
        yield 'xdg data dir' => [
            (new MimeDatabaseGenerator())
                ->useXdgDirectories()
                ->addCustomPaths($dataDir),
            ['XDG_DATA_HOME' => $dataDir, 'XDG_DATA_DIRS' => $dataDir],
        ];
    }
}
