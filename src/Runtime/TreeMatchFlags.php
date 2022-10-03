<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

/**
 * @internal
 */
final class TreeMatchFlags
{
    public const CASE_SENSITIVE = 0b001;
    public const EXECUTABLE = 0b010;
    public const NON_EMPTY = 0b100;

    private const TYPE_SHIFT = 4;
    public const TYPE_MASK = 3 << self::TYPE_SHIFT;

    public const TYPE_ANY = 0;
    public const TYPE_FILE = 1 << self::TYPE_SHIFT;
    public const TYPE_DIR = 2 << self::TYPE_SHIFT;
    public const TYPE_LINK = 3 << self::TYPE_SHIFT;
}
