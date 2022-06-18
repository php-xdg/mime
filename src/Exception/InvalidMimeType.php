<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Exception;

final class InvalidMimeType extends \RuntimeException
{
    public function __construct(string $type)
    {
        parent::__construct("Invalid MIME Type: {$type}");
    }
}
