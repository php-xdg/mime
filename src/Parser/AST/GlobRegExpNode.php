<?php declare(strict_types=1);

namespace Xdg\Mime\Parser\AST;

/**
 * @internal
 */
final class GlobRegExpNode extends CompositeNode
{
    /**
     * @param GlobNode[] $children
     */
    public function __construct(
        public string $pattern,
        public array $children,
    ) {
    }
}
