<?php declare(strict_types=1);

namespace ju1ius\XDGMime;

/**
 * MimeDatabase lazy-loading proxy.
 */
final class LazyMimeDatabase extends MimeDatabase
{
    private ?MimeDatabase $database = null;

    public function __construct(
        private \Closure $initializer,
    ) {
    }

    public function getCanonicalType(MimeType|string $type): MimeType
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->getCanonicalType($type);
    }

    public function getParentTypes(MimeType|string $type): array
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->getParentTypes($type);
    }

    public function guessTypeByFileName(string $path): MimeType
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessTypeByFileName($path);
    }

    public function guessTypeByData(string $data, int $maxPriority = 100, int $minPriority = 0): MimeType
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessTypeByData($data, $maxPriority, $minPriority);
    }

    public function guessTypeByContents(string $path, int $maxPriority = 100, int $minPriority = 0): MimeType
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessTypeByContents($path, $maxPriority, $minPriority);
    }

    public function guessType(string $path, bool $followLinks = true): MimeType
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessType($path, $followLinks);
    }
}
