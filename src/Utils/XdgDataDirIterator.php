<?php declare(strict_types=1);

namespace Xdg\Mime\Utils;

/**
 * @internal
 */
final class XdgDataDirIterator implements \IteratorAggregate
{
    private const ENV_KEYS = [
        'HOME',
        'XDG_DATA_HOME',
        'XDG_DATA_DIRS',
    ];

    public function __construct(
        private readonly array $env = [],
    ) {
    }

    public static function fromGlobals(): self
    {
        $env = [];
        foreach (self::ENV_KEYS as $key) {
            if ($value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key)) {
                $env[$key] = $value;
            }
        }
        return new self($env);
    }

    public function getIterator(): \Traversable
    {
        $home = $this->env['HOME'] ?? null;
        if ($dataHome = $this->env['XDG_DATA_HOME'] ?? null) {
            yield $dataHome;
        } elseif ($home) {
            yield "{$home}/.local/share";
        }
        $dataDirs = explode(':', $this->env['XDG_DATA_DIRS'] ?? '/usr/local/share:/usr/share');
        foreach ($dataDirs as $dataDir) {
            yield $dataDir;
        }
    }
}
