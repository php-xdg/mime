<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization\Lookup;

use Xdg\Mime\Compiler\Optimization\AbstractNodeVisitor;
use Xdg\Mime\Parser\AST\GlobNode;
use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Parser\AST\Node;

/**
 * @internal
 */
final class PopulateGlobLookup extends AbstractNodeVisitor
{
    private readonly MimeInfoNode $info;

    public function beforeTraverse(MimeInfoNode $node): MimeInfoNode
    {
        return $this->info = $node;
    }

    public function afterTraverse(MimeInfoNode $node): MimeInfoNode
    {
        $compareGlobs = self::compareGlobs(...);
        usort($node->globs, $compareGlobs);
        foreach (array_keys($node->caseSensitiveExtensionGlobs) as $ext) {
            usort($node->caseSensitiveExtensionGlobs[$ext], $compareGlobs);
        }
        foreach (array_keys($node->extensionGlobs) as $ext) {
            usort($node->extensionGlobs[$ext], $compareGlobs);
        }

        return $node;
    }

    public function leaveNode(Node $node): Node
    {
        if (!$node instanceof GlobNode) {
            return $node;
        }

        if ($node->isLiteral && $node->isExtensionGlob) {
            if ($node->caseSensitive) {
                $this->info->caseSensitiveExtensionGlobs[$node->extension][] = $node;
            } else {
                $this->info->extensionGlobs[strtolower($node->extension)][] = $node;
            }
        } elseif ($node->isLiteral) {
            if ($node->caseSensitive) {
                $this->info->caseSensitiveLiteralGlobs[$node->pattern] = $node;
            } else {
                $this->info->literalGlobs[strtolower($node->pattern)] = $node;
            }
        } else {
            $this->info->globs[] = $node;
        }

        return $node;
    }

    private static function compareGlobs(GlobNode $a, GlobNode $b): int
    {
        return $b->weight <=> $a->weight ?: \strlen($b->pattern) <=> \strlen($a->pattern);
    }
}
