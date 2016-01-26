<?php

namespace ju1ius\XDGMime;

/**
 * @author ju1ius
 */
class InvalidMimeType extends \RuntimeException
{
    /**
     * InvalidMimeType constructor.
     *
     * @param string $type
     */
    public function __construct($type)
    {
        parent::__construct("Invalid MIME Type: {$type}");
    }
}