<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\AST;

final class MagicRegexMatchNode extends MagicMatchNode
{
    public function __construct(
        public string $pattern,
        public string $compiledPattern,
        public int $maxLength,
    ) {
        parent::__construct('regexp', 0, 0, '', '', 1);
    }

    public function getMaxLength(): int
    {
        return $this->maxLength;
    }
}
