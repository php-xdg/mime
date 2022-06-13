<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

use ju1ius\XDGMime\MimeType;

class LazyMimeDatabase implements MimeDatabaseInterface
{
    use MimeDatabaseTrait {
        getCanonicalType as private doGetCanonicalType;
        getAncestors as private doGetAncestors;
        guessType as private doGuessType;
        guessTypeByFileName as private doGuessTypeByFileName;
        guessTypeByData as private doGuessTypeByData;
        guessTypeByContents as private doGuessTypeByContents;
    }

    public function __construct(
        private readonly string $directory,
    ) {
    }

    final public function getCanonicalType(MimeType $type): MimeType
    {
        $this->aliases ??= require "{$this->directory}/aliases.php";
        return $this->doGetCanonicalType($type);
    }

    final public function getAncestors(MimeType $type): array
    {
        $this->subclasses ??= require "{$this->directory}/subclasses.php";
        return $this->doGetAncestors($type);
    }

    final public function guessType(string $path, bool $followLinks = true): MimeType
    {
        $this->subclasses ??= require "{$this->directory}/subclasses.php";
        $this->globs ??= require "{$this->directory}/globs.php";
        $this->magic ??= require "{$this->directory}/magic.php";
        return $this->doGuessType($path, $followLinks);
    }

    final public function guessTypeByFileName(string $path): MimeType
    {
        $this->globs ??= require "{$this->directory}/globs.php";
        return $this->doGuessTypeByFileName($path);
    }

    final public function guessTypeByData(string $buffer): MimeType
    {
        $this->magic ??= require "{$this->directory}/magic.php";
        return $this->doGuessTypeByData($buffer);
    }

    final public function guessTypeByContents(string $path): MimeType
    {
        $this->magic ??= require "{$this->directory}/magic.php";
        return $this->doGuessTypeByContents($path);
    }
}
