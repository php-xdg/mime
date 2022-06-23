<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Glob;

use ju1ius\XdgMime\Compiler\Optimization\AbstractNodeVisitor;
use ju1ius\XdgMime\Parser\AST\GlobNode;
use ju1ius\XdgMime\Parser\AST\GlobRegExpNode;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
final class CombineExpensiveGlobs extends AbstractNodeVisitor
{
    private readonly GlobToRegExpTranslator $translator;

    public function __construct()
    {
        $this->translator = new GlobToRegExpTranslator('~');
    }

    public function afterTraverse(MimeInfoNode $node): MimeInfoNode
    {
        if (\count($node->globs) < 2) {
            return $node;
        }

        $newChildren = [];
        $toCompile = [];
        foreach ($node->globs as $glob) {
            try {
                $toCompile[] = [$glob, $this->compileGlob($glob)];
            } catch (GlobTranslationError) {
                if ($toCompile) {
                    $newChildren[] = match (\count($toCompile)) {
                        1 => $toCompile[0][0],
                        default => $this->joinGlobs($toCompile),
                    };
                }
                $toCompile = [];
                $newChildren[] = $glob;
            }
        }
        if ($toCompile) {
            $newChildren[] = match (\count($toCompile)) {
                1 => $toCompile[0][0],
                default => $this->joinGlobs($toCompile),
            };
        }

        $node->globs = $newChildren;

        return $node;
    }

    private function compileGlob(GlobNode $node): string
    {
        $pattern = $this->translator->translate($node->pattern);
        if ($node->caseSensitive) {
            $pattern = sprintf('(?-i:%s)', $pattern);
        }
        return $pattern;
    }

    private function joinGlobs(array $toCompile): GlobRegExpNode
    {
        $globs = [];
        $patterns = [];
        foreach ($toCompile as $index => [$glob, $pattern]) {
            $globs[] = $glob;
            $patterns[] = sprintf('(*:%d)%s', $index, $pattern);
        }

        $pattern = sprintf(
            '~(?n)\A(%s)\z~Si',
            implode('|', $patterns),
        );

        return new GlobRegExpNode($pattern, $globs);
    }
}
