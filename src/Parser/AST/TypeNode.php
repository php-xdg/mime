<?php declare(strict_types=1);

namespace Xdg\Mime\Parser\AST;

/**
 * @internal
 */
final class TypeNode extends Node
{
    /**
     * @var string[]
     */
    public array $aliases = [];

    /**
     * @var string[]
     */
    public array $subclassOf = [];

    public ?string $icon = null;

    public ?string $genericIcon = null;

    /**
     * @var GlobNode[]
     */
    public array $globs = [];

    /**
     * @var MagicRuleNode[]
     */
    public array $magic = [];

    /**
     * @var TreeMagicNode[]
     */
    public array $treeMagic = [];

    /**
     * @var RootXmlNode[]
     */
    public array $rootXmlNodes = [];

    public function __construct(public readonly string $name)
    {
    }
}
