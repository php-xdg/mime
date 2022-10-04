<?php declare(strict_types=1);

namespace Xdg\Mime;

use Xdg\BaseDirectory\XdgBaseDirectory;
use Xdg\Mime\Compiler\MimeDatabaseCompiler;
use Xdg\Mime\Parser\MimeDatabaseParser;

final class MimeDatabaseGenerator implements MimeDatabaseGeneratorInterface
{
    private bool $useXdgDirs = true;
    private array $customPaths = [];
    private bool $enableOptimizations = true;
    private bool $isPlatformDependent = false;

    /**
     * Static constructor for method chaining.
     */
    public static function new(): self
    {
        return new self();
    }

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

    /**
     * Disables compiler optimizations (useful only for debugging, don't use this in production).
     *
     * @return $this
     */
    public function disableOptimizations(): self
    {
        $this->enableOptimizations = false;
        return $this;
    }

    /**
     * Use this if you're compiling on your runtime environment.
     *
     * @return $this
     */
    public function enablePlatformDependentOptimizations(): self
    {
        $this->enableOptimizations = true;
        $this->isPlatformDependent = true;
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
        $compiler = new MimeDatabaseCompiler($this->isPlatformDependent, $this->enableOptimizations);
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
        return XdgBaseDirectory::fromEnvironment()
            ->collectDataPaths('mime/packages', is_dir(...))
        ;
    }
}
