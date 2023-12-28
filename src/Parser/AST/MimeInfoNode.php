<?php declare(strict_types=1);

namespace Xdg\Mime\Parser\AST;

/**
 * @extends CompositeNode<TypeNode>
 * @internal
 */
final class MimeInfoNode extends CompositeNode
{
    /**
     * @var array<string, string[]>
     */
    public array $hierarchyLookup = [];

    /**
     * @var array<string, string>
     */
    public array $aliasLookup = [];

    /**
     * @var array<string, string>
     */
    public array $iconLookup = [];

    /**
     * @var array<string, string>
     */
    public array $genericIconLookup = [];

    /**
     * @var MagicRuleNode[]
     */
    public array $magic = [];

    /**
     * @var TreeMagicNode[]
     */
    public array $treeMagic = [];

    /**
     * @var array<GlobNode>
     */
    public array $globs = [];

    /**
     * @var array<string, GlobNode[]>
     */
    public array $extensionGlobs = [];

    /**
     * @var array<string, GlobNode[]>
     */
    public array $caseSensitiveExtensionGlobs = [];

    /**
     * @var array<string, GlobNode>
     */
    public array $literalGlobs = [];

    /**
     * @var array<string, GlobNode>
     */
    public array $caseSensitiveLiteralGlobs = [];

    /**
     * @var array<string, array<string, string>>
     */
    public array $xmlNamespaceLookup = [];

    public function createType(string $name): TypeNode
    {
        return $this->children[$name] ??= new TypeNode($name);
    }
}
