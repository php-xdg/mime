<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

use ju1ius\XDGMime\Runtime\LazyMimeDatabase;

final class XdgMimeDatabase extends LazyMimeDatabase
{
    public function __construct(string $directory = __DIR__ . '/Resources/db')
    {
        parent::__construct($directory);
    }
}
