<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

use ju1ius\XdgMime\MimeDatabaseInterface;

/**
 * @internal
 */
final class TreeMagicMatch
{
    /**
     * @param self[] $and
     */
    public function __construct(
        public string $path,
        public readonly int $flags = 0,
        public ?string $mimeType = null,
        public readonly array $and = [],
    ) {
    }

    public function matches(string $rootPath, MimeDatabaseInterface $db): bool
    {
        if (!$this->doMatch($rootPath, $db)) {
            return false;
        }
        if (!$this->and) {
            return true;
        }
        foreach ($this->and as $matchlet) {
            if ($matchlet->matches($rootPath, $db)) {
                return true;
            }
        }
        return false;
    }

    private function doMatch(string $rootPath, MimeDatabaseInterface $db): bool
    {
        foreach ($this->matchingPaths($rootPath) as $file) {
            if (! match ($this->flags & TreeMatchFlags::TYPE_MASK) {
                TreeMatchFlags::TYPE_DIR => $file->isDir(),
                TreeMatchFlags::TYPE_LINK => $file->isLink(),
                TreeMatchFlags::TYPE_FILE => $file->isFile(),
                TreeMatchFlags::TYPE_ANY => true,
            }) {
                continue;
            }

            if (($this->flags & TreeMatchFlags::EXECUTABLE) && !$file->isExecutable()) {
                continue;
            }

            if (($this->flags & TreeMatchFlags::NON_EMPTY) && $file->isDir() && $this->isEmptyDirectory($file)) {
                continue;
            }

            if ($this->mimeType) {
                $type = $db->guessType($file->getPathname());
                if (!$type->is($this->mimeType)) {
                    continue;
                }
            }
            return true;
        }

        return false;
    }

    /**
     * @param string $rootPath
     * @return \Traversable<\SplFileInfo>
     */
    private function matchingPaths(string $rootPath): \Traversable
    {
        if ($this->flags & TreeMatchFlags::CASE_SENSITIVE) {
            if (file_exists($fullPath = "{$rootPath}/{$this->path}")) {
                yield new \SplFileInfo($fullPath);
            }
            return;
        }

        $components = explode('/', $this->path);
        $targetDepth = \count($components);
        $currentRoots = [$rootPath];
        $currentDepth = 1;
        while ($currentDepth <= $targetDepth) {
            $search = array_shift($components);
            $nextRoots = [];
            foreach ($currentRoots as $currentRoot) {
                /** @var \SplFileInfo $file */
                foreach (new \FilesystemIterator($currentRoot) as $file) {
                    if (strcasecmp($search, $file->getFilename()) === 0) {
                        if ($currentDepth === $targetDepth) {
                            yield $file;
                        } else {
                            $nextRoots[] = $file->getPathname();
                        }
                    }
                }
            }
            $currentRoots = $nextRoots;
            $currentDepth++;
        }
    }

    private function isEmptyDirectory(\SplFileInfo $file): bool
    {
        foreach (new \FilesystemIterator($file->getPathname()) as $file) {
            return false;
        }
        return true;
    }
}
