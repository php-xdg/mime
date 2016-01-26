<?php

namespace ju1ius\XDGMime;

/**
 * MimeDatabase lazy-loading proxy.
 *
 * @author ju1ius
 */
final class LazyMimeDatabase extends MimeDatabase
{
    /**
     * @var MimeDatabase
     */
    private $database;
    /**
     * @var \Closure
     */
    private $initializer;

    /**
     * LazyMimeDatabase constructor.
     *
     * @param \Closure $initializer
     */
    public function __construct(\Closure $initializer)
    {
        $this->initializer = $initializer;
    }

    public function getCanonicalType($type)
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->getCanonicalType($type);
    }

    public function getParentTypes($type)
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->getParentTypes($type);
    }

    public function guessTypeByFileName($path)
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessTypeByFileName($path);
    }

    public function guessTypeByData($data, $maxPriority = 100, $minPriority = 0)
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessTypeByData($data, $maxPriority, $minPriority);
    }

    public function guessTypeByContents($path, $maxPriority = 100, $minPriority = 0)
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessTypeByContents($path, $maxPriority, $minPriority);
    }

    public function guessType($path, $followLinks = true)
    {
        $this->initializer && $this->initializer->__invoke($this->database, $this->initializer);
        return $this->database->guessType($path, $followLinks);
    }
}