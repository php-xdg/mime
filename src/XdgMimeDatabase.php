<?php declare(strict_types=1);

namespace ju1ius\XdgMime;

use ju1ius\XdgMime\Runtime\MimeDatabaseTrait;

final class XdgMimeDatabase implements MimeDatabaseInterface
{
    use MimeDatabaseTrait {
        getCanonicalType as private doGetCanonicalType;
        getAncestors as private doGetAncestors;
        guessType as private doGuessType;
        guessTypeByFileName as private doGuessTypeByFileName;
        guessTypeByData as private doGuessTypeByData;
        guessTypeByContents as private doGuessTypeByContents;
        guessTypeForTree as private doGuessTypeForTree;
    }

    public function __construct(
        private readonly string $directory = __DIR__ . '/Resources/db',
    ) {
    }

    public function getCanonicalType(MimeType $type): MimeType
    {
        $this->aliases ??= require $this->directory . '/aliases.php';
        return $this->doGetCanonicalType($type);
    }

    public function getAncestors(MimeType $type): array
    {
        $this->aliases ??= require $this->directory . '/aliases.php';
        $this->subclasses ??= require $this->directory . '/subclasses.php';
        return $this->doGetAncestors($type);
    }

    public function guessType(string $path, bool $followLinks = true): MimeType
    {
        $this->subclasses ??= require $this->directory . '/subclasses.php';
        $this->globs ??= require $this->directory . '/globs.php';
        $this->magic ??= require $this->directory . '/magic.php';
        return $this->doGuessType($path, $followLinks);
    }

    public function guessTypeByFileName(string $path): MimeType
    {
        $this->globs ??= require $this->directory . '/globs.php';
        return $this->doGuessTypeByFileName($path);
    }

    public function guessTypeByData(string $buffer): MimeType
    {
        $this->magic ??= require $this->directory . '/magic.php';
        return $this->doGuessTypeByData($buffer);
    }

    public function guessTypeByContents(string $path): MimeType
    {
        $this->magic ??= require $this->directory . '/magic.php';
        return $this->doGuessTypeByContents($path);
    }

    public function guessTypeForTree(string $rootPath): MimeType
    {
        $this->treeMagic ??= require $this->directory . '/treemagic.php';
        return $this->doGuessTypeForTree($rootPath);
    }
}
