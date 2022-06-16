<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Node;

/**
 * @extends CompositeNode<TypeNode>
 * @internal
 */
final class MimeInfoNode extends CompositeNode
{
    public function createType(string $name): TypeNode
    {
        return $this->children[$name] ??= new TypeNode($name);
    }
}
