<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

use ju1ius\XDGMime\Aliases\AliasesDatabaseBuilder;
use ju1ius\XDGMime\Compiler\MimeDatabaseCompiler;
use ju1ius\XDGMime\Globs\GlobsDatabaseBuilder;
use ju1ius\XDGMime\Magic\MagicDatabaseBuilder;
use ju1ius\XDGMime\Parser\MimeDatabaseParser;
use ju1ius\XDGMime\Subclasses\SubclassesDatabaseBuilder;
use ju1ius\XDGMime\Utils\XdgBaseDir;
use Symfony\Component\Filesystem\Path;

class MimeDatabaseFactory
{
    private ?string $cacheDir = null;
    private bool $useXdgDirs = true;
    private array $customPaths = [];

    public function setCacheDir(?string $path): static
    {
        $this->cacheDir = $path;
        return $this;
    }

    public function useXdgDirectories(bool $use = true): static
    {
        $this->useXdgDirs = $use;
        return $this;
    }

    public function withCustomPath(string ...$paths): static
    {
        array_push($this->customPaths, ...$paths);
        return $this;
    }

    public function create(): MimeDatabase
    {
        $files = [];
        if ($this->useXdgDirs) {
            $dataPaths = self::loadXdgDataPaths('mime/packages');
            $files = self::findXmlFilesIn($dataPaths);
        }
        foreach ($this->customPaths as $path) {
            if (is_dir($path)) {
                $files = array_merge($files, self::findXmlFilesIn($path));
            } else {
                $files[] = $path;
            }
        }
        $parser = new MimeDatabaseParser();
        $compiler = new MimeDatabaseCompiler();
        $ast = $parser->parse($files);
        $code = $compiler->compile($ast);
    }

    private static function findXmlFilesIn(array $directories): array
    {
        $files = [];
        foreach ($directories as $directory) {
            $overrides = null;
            foreach (glob("{$directory}/*.xml") as $file) {
                if (basename($file) === 'Overrides.xml') {
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

    private static function loadXdgDataPaths(string $path): array
    {
        return array_reverse(iterator_to_array(XdgBaseDir::dataPaths($path)));
    }
}
