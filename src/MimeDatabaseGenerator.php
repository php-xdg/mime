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
        $files = array_unique($this->loadFiles());
        if (!$files) {
            throw new \LengthException(
                'No files were found using the given configuration.'
                . ' Try adjusting the XDG_DATA_HOME and XDG_DATA_DIRS environment variables,'
                . ' or adding your own custom paths.'
            );
        }
        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $compiler->compileToDirectory($parser->parse(...$files), $outputDirectory);
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
            } elseif (is_file($path)) {
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
