<?php

namespace ju1ius\XDGMime\Subclasses;

use ju1ius\XDGMime\MimeType;

/**
 * A mapping from MIME types to types they inherit from.
 *
 * @author ju1ius
 */
class SubclassesDatabase
{
    /**
     * [
     *  'mime/type' => ['parent/type', 'parent/type', ...]
     * ]
     * @var array
     */
    private $subclasses = [];

    /**
     * @param MimeType $subclass
     * @param MimeType $parent
     *
     * @return $this
     */
    public function add(MimeType $subclass, MimeType $parent)
    {
        $sub = (string)$subclass;
        if (!isset($this->subclasses[$sub])) {
            $this->subclasses[$sub] = [];
        }

        $this->subclasses[$sub][(string)$parent] = $parent;

        return $this;
    }

    /**
     * @param MimeType $type
     *
     * @return MimeType[]
     */
    public function getParents(MimeType $type)
    {
        $type = (string)$type;
        if (!isset($this->subclasses[$type])) {
            return [];
        }

        return array_values($this->subclasses[$type]);
    }
}