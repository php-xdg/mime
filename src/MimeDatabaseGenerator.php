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
            $dataPaths = $this->loadXdgDataPaths('mime/packages');
            $files = $this->findXmlFilesIn($dataPaths);
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

    private function findXmlFilesIn(array $directories): array
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

    private function loadXdgDataPaths(string $path): array
    {
        $it = XdgDataDirIterator::fromGlobals();
        return array_reverse(iterator_to_array($it->dataPaths($path)));
    }
}
