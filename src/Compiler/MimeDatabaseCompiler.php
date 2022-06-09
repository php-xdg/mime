<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler;

use ju1ius\XDGMime\Parser\Node\GlobNode;
use ju1ius\XDGMime\Parser\Node\TypeNode;
use ju1ius\XDGMime\Runtime\Glob;
use ju1ius\XDGMime\Runtime\GlobLiteral;

final class MimeDatabaseCompiler
{
    /**
     * @param array<string, TypeNode> $types
     */
    public function compile(array $types): string
    {
        $lookup = $this->createLookup($types);
        $tpl = <<<'PHP'
        <?php

        use ju1ius\XDGMime\Runtime\Glob;
        use ju1ius\XDGMime\Runtime\GlobLiteral;

        return [
            'subclasses' => %s,
            'aliases' => %s,
            'globs' => %s,
        ];
        PHP;

        return sprintf(
            $tpl,
            $this->compileSubClasses($lookup['subclasses'], 1),
            $this->compileAliases($lookup['aliases'], 1),
            $this->compileGlobs($lookup['globs'], 1),
        );
    }

    /**
     * @param array<string, TypeNode> $types
     * @return array
     */
    private function createLookup(array $types): array
    {
        $aliases = [];
        $subclasses = [];
        $globs = [];
        foreach ($types as $canonical => $type) {
            if ($type->subclassOf) {
                $subclasses[$canonical] = $type->subclassOf;
            }
            foreach ($type->aliases as $alias) {
                $aliases[$alias] = $canonical;
            }
            foreach ($type->globs as $glob) {
                $globs[] = $glob;
            }
            // TODO: Magic
            // TODO: TreeMagic
        }

        return [
            'subclasses' => $subclasses,
            'aliases' => $aliases,
            'globs' => $this->createGlobLookup($globs),
            'magic' => [],
            'treemagic' => [],
        ];
    }

    private function compileSubClasses(array $lookup, int $indentLevel = 0): string
    {
        $indent = str_repeat('    ', $indentLevel);
        $entries = [];
        foreach ($lookup as $key => $value) {
            $entries[] = sprintf(
                '%s    %s => [%s],',
                $indent,
                var_export($key, true),
                implode(', ', array_map(fn($v) => var_export($v, true), $value)),
            );
        }
        return sprintf(
            "[\n%s\n%s]",
            implode("\n", $entries),
            $indent,
        );
    }

    private function compileAliases(array $lookup, int $indentLevel = 0): string
    {
        $indent = str_repeat('    ', $indentLevel);
        $entries = [];
        foreach ($lookup as $key => $value) {
            $entries[] = sprintf(
                '%s    %s => %s,',
                $indent,
                var_export($key, true),
                var_export($value, true),
            );
        }
        return sprintf(
            "[\n%s\n%s]",
            implode("\n", $entries),
            $indent,
        );
    }

    private function compileGlobs(array $lookup, int $indentLevel = 0): string
    {
        $indent = str_repeat('    ', $indentLevel);
        $literalKeys = [
            'case_sensitive_extensions',
            'extensions',
            'case_sensitive_literals',
            'literals',
        ];
        $output = "[\n";
        foreach ($literalKeys as $lookupKey) {
            $hashMap = $lookup[$lookupKey];
            if (!$hashMap) {
                continue;
            }
            $indent = str_repeat('    ', ++$indentLevel);
            $output .= sprintf(
                "%s'%s' => [\n",
                $indent,
                $lookupKey,
            );
            /** @var GlobLiteral|GlobLiteral[] $value */
            foreach ($hashMap as $key => $value) {
                $output .= sprintf(
                    "%s    '%s' => %s,\n",
                    $indent,
                    $key,
                    is_array($value)
                        ? sprintf(
                            '[%s]',
                            implode(', ', array_map($this->compileGlobLiteral(...), $value))
                        )
                        : $this->compileGlobLiteral($value),
                );
            }
            $indent = str_repeat('    ', --$indentLevel);
            $output .= sprintf("%s    ],\n", $indent);
        }

        $indent = str_repeat('    ', ++$indentLevel);
        $output .= sprintf("%s'globs' => [\n", $indent);
        /** @var Glob $glob */
        foreach ($lookup['globs'] as $glob) {
            $output .= sprintf(
                "%s    new Glob(%s, %d, %s, %s),\n",
                $indent,
                var_export($glob->type, true),
                $glob->weight,
                var_export($glob->pattern, true),
                var_export($glob->caseSensitive, true),
            );
        }
        $output .= sprintf("%s],\n", $indent);

        $indent = str_repeat('    ', --$indentLevel);
        $output .= sprintf("%s]", $indent);
        return $output;
    }

    private function compileGlobLiteral(GlobLiteral $glob): string
    {
        return sprintf(
            'new GlobLiteral(%s, %d, %d)',
            var_export($glob->type, true),
            $glob->weight,
            $glob->length,
        );
    }

    /**
     * @param GlobNode[] $globs
     */
    private function createGlobLookup(array $globs): array
    {
        $lookup = [
            'case_sensitive_extensions' => [],
            'extensions' => [],
            'case_sensitive_literals' => [],
            'literals' => [],
            'globs' => [],
        ];
        foreach ($globs as $node) {
            if ($node->isLiteral && $node->isExtensionGlob) {
                $glob = new GlobLiteral($node->type, $node->weight, \strlen($node->pattern));
                if ($node->caseSensitive) {
                    $lookup['case_sensitive_extensions'][$node->extension][] = $glob;
                } else {
                    $lookup['extensions'][strtolower($node->extension)][] = $glob;
                }
            } elseif ($node->isLiteral) {
                $glob = new GlobLiteral($node->type, $node->weight, \strlen($node->pattern));
                if ($node->caseSensitive) {
                    $lookup['case_sensitive_literals'][$node->pattern] = $glob;
                } else {
                    $lookup['literals'][strtolower($node->pattern)] = $glob;
                }
            } else {
                $lookup['globs'][] = new Glob($node->type, $node->weight, $node->pattern, $node->caseSensitive);
            }
        }

        $compareGlobs = self::compareGlobs(...);
        foreach (array_keys($lookup['case_sensitive_extensions']) as $ext) {
            usort($lookup['case_sensitive_extensions'][$ext], $compareGlobs);
        }
        foreach (array_keys($lookup['extensions']) as $ext) {
            usort($lookup['extensions'][$ext], $compareGlobs);
        }
        //uasort($lookup['case_sensitive_literals'], $compareGlobs);
        //uasort($lookup['literals'], $compareGlobs);
        usort($lookup['globs'], $compareGlobs);

        return $lookup;
    }

    private static function compareGlobs(GlobLiteral $a, GlobLiteral $b): int
    {
        return $b->weight <=> $a->weight ?: $b->length <=> $a->length;
    }
}
