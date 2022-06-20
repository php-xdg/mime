<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Parser\AST;

/**
 * @internal
 */
final class MagicRegexNode extends MagicMatchNode
{
    public function __construct(
        public string $pattern,
        public string $compiledPattern,
        public int $maxLength,
        array $children = [],
    ) {
        parent::__construct('regexp', 0, 0, '', '', 1, $children);
    }

    public function getMaxLength(): int
    {
        return $this->maxLength;
    }
}
