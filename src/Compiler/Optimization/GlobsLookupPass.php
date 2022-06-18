<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization;

use ju1ius\XdgMime\Parser\AST\GlobNode;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

final class GlobsLookupPass implements OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode
    {
        $globs = [];
        foreach ($info->children as $type) {
            foreach ($type->globs as $glob) {
                $globs[] = $glob;
            }
        }
        foreach ($globs as $node) {
            if ($node->isLiteral && $node->isExtensionGlob) {
                if ($node->caseSensitive) {
                    $info->caseSensitiveExtensionGlobs[$node->extension][] = $node;
                } else {
                    $info->extensionGlobs[strtolower($node->extension)][] = $node;
                }
            } elseif ($node->isLiteral) {
                if ($node->caseSensitive) {
                    $info->caseSensitiveLiteralGlobs[$node->pattern] = $node;
                } else {
                    $info->literalGlobs[strtolower($node->pattern)] = $node;
                }
            } else {
                $info->globs[] = $node;
            }
        }

        $compareGlobs = self::compareGlobs(...);
        usort($info->globs, $compareGlobs);
        foreach (array_keys($info->caseSensitiveExtensionGlobs) as $ext) {
            usort($info->caseSensitiveExtensionGlobs[$ext], $compareGlobs);
        }
        foreach (array_keys($info->extensionGlobs) as $ext) {
            usort($info->extensionGlobs[$ext], $compareGlobs);
        }

        return $info;
    }

    private static function compareGlobs(GlobNode $a, GlobNode $b): int
    {
        return $b->weight <=> $a->weight ?: \strlen($b->pattern) <=> \strlen($a->pattern);
    }
}
