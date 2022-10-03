<?php declare(strict_types=1);

namespace Xdg\Mime;

use Xdg\Mime\Exception\InvalidMimeType;

final class MimeType implements \Stringable
{
    /**
     * @var array<string, self>
     */
    private static array $instances = [];

    private function __construct(
        public readonly string $media,
        public readonly string $subtype,
    ) {
    }

    public static function of(self|string $name): self
    {
        if ($name instanceof self) {
            return $name;
        }

        if ($type = self::$instances[$name] ?? null) {
            return $type;
        }

        $name = strtolower($name);
        if ($type = self::$instances[$name] ?? null) {
            return $type;
        }

        $parts = explode('/', $name);
        if (\count($parts) !== 2) {
            throw new InvalidMimeType($name);
        }

        return self::$instances[$name] = new self($parts[0], $parts[1]);
    }

    public function withSubtype(string $subtype): self
    {
        return self::of($this->media . '/' . $subtype);
    }

    public function is(self|string $other): bool
    {
        if (\is_string($other)) {
            return strcasecmp($this->media . '/' . $this->subtype, $other) === 0;
        }

        return $this === $other;
    }

    public function __toString(): string
    {
        return $this->media . '/' . $this->subtype;
    }

    public function __clone()
    {
        throw new \BadMethodCallException(sprintf(
            'Instances of %s are not cloneable.',
            __CLASS__,
        ));
    }

    //
    // Static constructors for default, well-known or special types
    // ---------------------------------------------------------------------------------------------------------------

    public static function unknown(): self
    {
        return self::of('application/octet-stream');
    }

    public static function defaultBinary(): self
    {
        return self::of('application/octet-stream');
    }

    public static function defaultText(): self
    {
        return self::of('text/plain');
    }

    public static function defaultExecutable(): self
    {
        return self::of('application/x-executable');
    }

    public static function directory(): self
    {
        return self::of('inode/directory');
    }

    public static function symlink(): self
    {
        return self::of('inode/symlink');
    }

    public static function characterDevice(): self
    {
        return self::of('inode/chardevice');
    }

    public static function blockDevice(): self
    {
        return self::of('inode/blockdevice');
    }

    public static function fifo(): self
    {
        return self::of('inode/fifo');
    }

    public static function socket(): self
    {
        return self::of('inode/socket');
    }

    public static function door(): self
    {
        return self::of('inode/door');
    }
}
