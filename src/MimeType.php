<?php

namespace ju1ius\XDGMime;

/**
 * @author ju1ius
 */
final class MimeType
{
    private static $instances = [];

    private $media;
    private $subtype;

    /**
     * MimeType constructor.
     *
     * @param $media
     * @param $subtype
     */
    private function __construct($media, $subtype)
    {
        $this->media = $media;
        $this->subtype = $subtype;
    }

    // No cloning !
    private function __clone() {}

    /**
     * @param string $name
     *
     * @return MimeType
     */
    public static function create($name)
    {
        if ($name instanceof self) return $name;

        // Avoid calling strtolower repeatedly
        if (isset(self::$instances[$name])) return self::$instances[$name];

        $name = strtolower($name);
        if (isset(self::$instances[$name])) return self::$instances[$name];

        $parts = explode('/', $name);
        if (count($parts) !== 2) {
            throw new InvalidMimeType($name);
        }

        $type = new self($parts[0], $parts[1]);
        self::$instances[$name] = $type;

        return $type;
    }

    /**
     * @param string $subtype
     *
     * @return MimeType
     */
    public function withSubtype($subtype)
    {
        return self::create($this->media . '/' . $subtype);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->media . '/' . $this->subtype;
    }

    /**
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return string
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    //
    // Static constructors for default, well-known or special types
    // ---------------------------------------------------------------------------------------------------------------

    public static function unknown()
    {
        return self::create('application/octet-stream');
    }
    public static function defaultBinary()
    {
        return self::create('application/octet-stream');
    }
    public static function defaultText()
    {
        return self::create('text/plain');
    }
    public static function defaultExecutable()
    {
        return self::create('application/executable');
    }

    public static function directory()
    {
        return self::create('inode/directory');
    }
    public static function symlink()
    {
        return self::create('inode/symlink');
    }

    public static function characterDevice()
    {
        return self::create('inode/chardevice');
    }
    public static function blockDevice()
    {
        return self::create('inode/blockdevice');
    }
    public static function fifo()
    {
        return self::create('inode/fifo');
    }
    public static function socket()
    {
        return self::create('inode/socket');
    }
    public static function door()
    {
        return self::create('inode/door');
    }
}