<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\CompositeNode;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;
use ju1ius\XdgMime\Parser\AST\Node;
use ju1ius\XdgMime\Parser\AST\TypeNode;

/**
 * @internal
 */
final class RecursivePass implements OptimizationPassInterface
{
    /**
     * @var NodeVisitorInterface[]
     */
    private array $visitors;

    public function __construct(
        NodeVisitorInterface ...$visitors,
    ) {
        $this->visitors = $visitors;
    }

    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($this->visitors as $visitor) {
            $info = $visitor->beforeTraverse($info);
        }

        foreach ($info->children as $i => $child) {
            $info->children[$i] = $this->traverseType($child);
        }

        foreach ($this->visitors as $visitor) {
            $info = $visitor->afterTraverse($info);
        }

        return $info;
    }

    private function traverseType(TypeNode $node): TypeNode
    {
        foreach ($this->visitors as $visitor) {
            $node = $visitor->enterNode($node);
        }

        foreach ($node->globs as $i => $child) {
            $node->globs[$i] = $this->traverseNode($child);
        }
        foreach ($node->magic as $i => $child) {
            $node->magic[$i] = $this->traverseNode($child);
        }
        foreach ($node->treeMagic as $i => $child) {
            $node->treeMagic[$i] = $this->traverseNode($child);
        }

        foreach ($this->visitors as $visitor) {
            $node = $visitor->leaveNode($node);
        }

        return $node;
    }

    private function traverseNode(Node $node): Node
    {
        foreach ($this->visitors as $visitor) {
            $node = $visitor->enterNode($node);
        }
        if ($node instanceof CompositeNode) {
            foreach ($node->children as $i => $child) {
                $node->children[$i] = $this->traverseNode($child);
            }
        }
        foreach ($this->visitors as $visitor) {
            $node = $visitor->leaveNode($node);
        }

        return $node;
    }
}
