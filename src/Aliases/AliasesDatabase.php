<?php

namespace ju1ius\XDGMime\Aliases;

use ju1ius\XDGMime\MimeType;

/**
 * Class AliasesDatabase
 *
 * @author ju1ius
 */
class AliasesDatabase
{
    private $aliases = [];

    /**
     * AliasesDatabase constructor.
     *
     * @param array $aliases
     */
    public function __construct(array $aliases)
    {
        $this->aliases = $aliases;
    }

    public function canonical(MimeType $alias)
    {
        $key = (string) $alias;
        return isset($this->aliases[$key]) ? $this->aliases[$key] : $alias;
    }

    /**
     * Get an alias, or the provided default if not found.
     *
     * @param string $alias
     * @param string $default
     *
     * @return string|mixed
     */
    public function get($alias, $default=null)
    {
        $key = (string) $alias;
        return isset($this->aliases[$key]) ? $this->aliases[$key] : $default;
    }
}
