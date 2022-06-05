<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Utils;

use Symfony\Component\Filesystem\Path;

final class XdgBaseDir
{
    public static function dataPaths(string $path): \Traversable
    {
        foreach (self::dataDirs() as $dataDir) {
            $p = "{$dataDir}/{$path}";
            if (file_exists($p)) {
                yield $p;
            }
        }
    }

    public static function dataDirs(): \Traversable
    {
        $home = Path::getHomeDirectory();
        yield $_ENV['XDG_DATA_HOME'] ?? "{$home}/.local/share";
        yield from explode(':', $_ENV['XDG_DATA_DIRS'] ?? "/usr/local/share:/usr/share");
    }
}
