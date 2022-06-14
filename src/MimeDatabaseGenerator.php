<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

use ju1ius\XDGMime\Compiler\MimeDatabaseCompiler;
use ju1ius\XDGMime\Parser\MimeDatabaseParser;
use ju1ius\XDGMime\Utils\XdgDataDirIterator;

final class MimeDatabaseGenerator
{
    private bool $useXdgDirs = true;
    private array $customPaths = [];

    public function useXdgDirectories(bool $use = true): self
    {
        $this->useXdgDirs = $use;
        return $this;
    }

    public function addCustomPaths(string ...$paths): self
    {
        array_push($this->customPaths, ...$paths);
        return $this;
    }

    public function generate(string $outputDirectory): void
    {
        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $ast = $parser->parse(...$this->loadFiles());
        $compiler->compileToDirectory($ast, $outputDirectory);
    }

    private function loadFiles(): array
    {
        $files = [];
        if ($this->useXdgDirs) {
            $files = $this->findXmlFilesIn(...$this->loadXdgDataPaths());
        }
        foreach ($this->customPaths as $path) {
            if (is_dir($path)) {
                $files = array_merge($files, $this->findXmlFilesIn($path));
            } else {
                $files[] = $path;
            }
        }
        return $files;
    }

    private function findXmlFilesIn(string ...$directories): array
    {
        $files = [];
        foreach ($directories as $directory) {
            $overrides = null;
            foreach (glob("{$directory}/*.xml") as $file) {
                if (basename($file) === 'Override.xml') {
                    $overrides = $file;
                } else {
                    $files[] = $file;
                }
            }
            if ($overrides) {
                $files[] = $overrides;
            }
        }
        return $files;
    }

    private function loadXdgDataPaths(): array
    {
        $dataPaths = [];
        foreach (XdgDataDirIterator::fromGlobals() as $dataDir) {
            if (is_dir($path = "{$dataDir}/mime/packages")) {
                $dataPaths[] = $path;
            }
        }

        return array_reverse($dataPaths);
    }
}
