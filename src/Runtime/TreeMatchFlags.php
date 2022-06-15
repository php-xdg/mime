<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

/**
 * @internal
 */
final class TreeMatchFlags
{
    const CASE_SENSITIVE = 0b001;
    const EXECUTABLE = 0b010;
    const NON_EMPTY = 0b100;

    private const TYPE_SHIFT = 4;
    const TYPE_MASK = 3 << self::TYPE_SHIFT;

    const TYPE_ANY = 0;
    const TYPE_FILE = 1 << self::TYPE_SHIFT;
    const TYPE_DIR = 2 << self::TYPE_SHIFT;
    const TYPE_LINK = 3 << self::TYPE_SHIFT;
}
