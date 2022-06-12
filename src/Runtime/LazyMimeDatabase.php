<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

use ju1ius\XDGMime\MimeType;

class LazyMimeDatabase extends MimeDatabase
{
    public function __construct(
        private readonly string $directory,
    ) {
    }

    public function getCanonicalType(MimeType $type): MimeType
    {
        $this->aliases ??= require "{$this->directory}/aliases.php";
        return parent::getCanonicalType($type);
    }

    public function getAncestors(MimeType $type): array
    {
        $this->subclasses ??= require "{$this->directory}/subclasses.php";
        return parent::getAncestors($type);
    }

    public function guessType(string $path, bool $followLinks = true): MimeType
    {
        $this->subclasses ??= require "{$this->directory}/subclasses.php";
        $this->globs ??= require "{$this->directory}/globs.php";
        $this->magic ??= require "{$this->directory}/magic.php";
        return parent::guessType($path, $followLinks);
    }

    public function guessTypeByFileName(string $path): MimeType
    {
        $this->globs ??= require "{$this->directory}/globs.php";
        return parent::guessTypeByFileName($path);
    }

    public function guessTypeByData(string $buffer): MimeType
    {
        $this->magic ??= require "{$this->directory}/magic.php";
        return parent::guessTypeByData($buffer);
    }

    public function guessTypeByContents(string $path): MimeType
    {
        $this->magic ??= require "{$this->directory}/magic.php";
        return parent::guessTypeByContents($path);
    }
}
