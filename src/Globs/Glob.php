<?php

namespace ju1ius\XDGMime\Globs;

use ju1ius\XDGMime\MimeType;

/**
 * Internal data structre fo the Glob2 database.
 * All fields are public for speed but shouldn't be modified after instanciation.
 *
 * @author ju1ius
 *
 * @internal
 */
class Glob
{
    /**
     * @var int
     */
    public $weight;
    /**
     * @var string
     */
    public $pattern;
    /**
     * @var MimeType
     */
    public $type;
    /**
     * @var bool
     */
    public $caseSensitive = false;

    /**
     * @var bool
     */
    public $isExtensionGlob = false;
    /**
     * @var null|string
     */
    public $extension = null;
    /**
     * @var bool|int
     */
    public $isLiteral = false;

    /**
     * Glob constructor.
     *
     * @param integer  $weight
     * @param string   $pattern
     * @param MimeType $type
     * @param bool     $caseSensitive
     */
    public function __construct($weight, $pattern, $type, $caseSensitive = false)
    {
        $this->weight = $weight;
        $this->pattern = $pattern;
        $this->type = $type;
        $this->caseSensitive = $caseSensitive;

        $this->isExtensionGlob = strpos($pattern, '*.') === 0;
        if ($this->isExtensionGlob) {
            $pattern = substr($pattern, 2);
            $this->extension = $pattern;
        }
        $this->isLiteral = preg_match('/[^\[*?]/', $pattern);
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function matches($name)
    {
        $flags = $this->caseSensitive ? 0 : FNM_CASEFOLD;
        return fnmatch($this->pattern, $name, $flags);
    }
}