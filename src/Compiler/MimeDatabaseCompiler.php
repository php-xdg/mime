<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler;

use ju1ius\XDGMime\Parser\Node\GlobNode;
use ju1ius\XDGMime\Parser\Node\MagicNode;
use ju1ius\XDGMime\Parser\Node\MatchNode;
use ju1ius\XDGMime\Parser\Node\TypeNode;
use ju1ius\XDGMime\Runtime\Glob;
use ju1ius\XDGMime\Runtime\GlobLiteral;

final class MimeDatabaseCompiler
{
    /**
     * @param array<string, TypeNode> $types
     */
    public function compileToString(array $types): string
    {
        $lookup = $this->createLookup($types);
        $tpl = <<<'PHP'
        use ju1ius\XDGMime\MimeDatabase;
        use ju1ius\XDGMime\Runtime\AliasesDatabase;
        use ju1ius\XDGMime\Runtime\Glob;
        use ju1ius\XDGMime\Runtime\GlobLiteral;
        use ju1ius\XDGMime\Runtime\GlobsDatabase;
        use ju1ius\XDGMime\Runtime\MagicDatabase;
        use ju1ius\XDGMime\Runtime\MagicMatch;
        use ju1ius\XDGMime\Runtime\MagicRule;
        use ju1ius\XDGMime\Runtime\SubclassesDatabase;

        return new MimeDatabase(
            new AliasesDatabase(%s),
            new SubclassesDatabase(%s),
            new GlobsDatabase(%s),
            new MagicDatabase(%s),
        );
        PHP;

        return sprintf(
            $tpl,
            $this->compileAliases($lookup['aliases'], 1),
            $this->compileSubClasses($lookup['subclasses'], 1),
            $this->compileGlobs($lookup['globs'], 1),
            $this->compileMagicRules($lookup['magic'], 1),
        );
    }

    public function compileToFile(array $types, string $path): void
    {
        $code = "<?php\n\n" . $this->compileToString($types);
        file_put_contents($path, $code);
    }

    public function compileToDirectory(array $types, string $path): void
    {
        $lookup = $this->createLookup($types);
        if (!is_dir($path)) {
            mkdir($path, 0o777, true);
        }
        file_put_contents(
            "{$path}/database.php",
            <<<'PHP'
            <?php
            return new ju1ius\XDGMime\LazyMimeDatabase(__DIR__);
            PHP
        );
        file_put_contents("{$path}/aliases.php", sprintf(
            <<<'PHP'
            <?php
            return new ju1ius\XDGMime\Runtime\AliasesDatabase(%s);
            PHP,
            $this->compileAliases($lookup['aliases'], 1),
        ));
        file_put_contents("{$path}/subclasses.php", sprintf(
            <<<'PHP'
            <?php
            return new ju1ius\XDGMime\Runtime\SubclassesDatabase(%s);
            PHP,
            $this->compileAliases($lookup['subclasses'], 1),
        ));
        file_put_contents("{$path}/globs.php", sprintf(
            <<<'PHP'
            <?php
            return new ju1ius\XDGMime\Runtime\GlobsDatabase(%s);
            PHP,
            $this->compileAliases($lookup['globs'], 1),
        ));
        file_put_contents("{$path}/magic.php", sprintf(
            <<<'PHP'
            <?php
            return new ju1ius\XDGMime\Runtime\MagicDatabase(%s);
            PHP,
            $this->compileMagicRules($lookup['magic'], 1),
        ));
        // TODO: treemagic
        file_put_contents("{$path}/treemagic.php", '');
    }

    /**
     * @param array<string, TypeNode> $types
     */
    private function createLookup(array $types): array
    {
        $aliases = [];
        $subclasses = [];
        $globs = [];
        $magicRules = [];
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
            foreach ($type->magic as $rule) {
                $magicRules[] = $rule;
            }
            // TODO: TreeMagic
        }

        return [
            'subclasses' => $subclasses,
            'aliases' => $aliases,
            'globs' => $this->createGlobLookup($globs),
            'magic' => $this->createMagicLookup($magicRules),
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
        $literalKeys = [
            'extensions',
            'caseSensitiveExtensions',
            'literals',
            'caseSensitiveLiterals',
        ];
        $output = "\n";
        foreach ($literalKeys as $lookupKey) {
            $indent = str_repeat('    ', ++$indentLevel);
            $hashMap = $lookup[$lookupKey];
            if (!$hashMap) {
                $output .= sprintf("%s%s: [],\n", $indent, $lookupKey);
                continue;
            }
            $output .= sprintf("%s%s: [\n", $indent, $lookupKey);
            /** @var GlobLiteral|GlobLiteral[] $value */
            foreach ($hashMap as $key => $value) {
                $output .= sprintf(
                    "%s    '%s' => %s,\n",
                    $indent,
                    $key,
                    \is_array($value)
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
        $output .= sprintf("%sglobs: [\n", $indent);
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
        $indent = str_repeat('    ', --$indentLevel);
        $output .= sprintf("%s    ],\n%s", $indent, $indent);
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

    private function compileMagicRules(array $lookup, int $indentLevel = 0): string
    {
        $indent = str_repeat('    ', ++$indentLevel);
        $output = sprintf(
            "\n%slookupBufferSize: %d,\n",
            $indent,
            $lookup['lookupBufferSize'],
        );

        $output .= sprintf("%srules: [\n", $indent);
        /** @var MagicNode $rule */
        foreach ($lookup['rules'] as $rule) {
            $indent = str_repeat('    ', ++$indentLevel);
            $output .= sprintf(
                "%snew MagicRule('%s', %d, [\n",
                $indent,
                $rule->type,
                $rule->priority,
            );
            foreach ($rule->matches as $match) {
                $output .= sprintf(
                    "%s    %s,\n",
                    $indent,
                    $this->compileMagicMatch($match),
                );
            }
            $output .= sprintf("%s]),\n", $indent);
            $indent = str_repeat('    ', --$indentLevel);
        }
        $output .= sprintf("%s],\n", $indent);

        $indent = str_repeat('    ', --$indentLevel);
        return $output . $indent;
    }

    private function compileMagicMatch(MatchNode $match): string
    {
        return sprintf(
            'new MagicMatch(%d, %d, %s, %s, %d, [%s])',
            $match->start,
            $match->end,
            $this->reprString($match->value),
            $this->reprString($match->mask),
            $match->wordSize,
            implode(', ', array_map($this->compileMagicMatch(...), $match->and)),
        );
    }

    /**
     * @param GlobNode[] $globs
     */
    private function createGlobLookup(array $globs): array
    {
        $lookup = [
            'extensions' => [],
            'caseSensitiveExtensions' => [],
            'literals' => [],
            'caseSensitiveLiterals' => [],
            'globs' => [],
        ];
        foreach ($globs as $node) {
            if ($node->isLiteral && $node->isExtensionGlob) {
                $glob = new GlobLiteral($node->type, $node->weight, \strlen($node->pattern));
                if ($node->caseSensitive) {
                    $lookup['caseSensitiveExtensions'][$node->extension][] = $glob;
                } else {
                    $lookup['extensions'][strtolower($node->extension)][] = $glob;
                }
            } elseif ($node->isLiteral) {
                $glob = new GlobLiteral($node->type, $node->weight, \strlen($node->pattern));
                if ($node->caseSensitive) {
                    $lookup['caseSensitiveLiterals'][$node->pattern] = $glob;
                } else {
                    $lookup['literals'][strtolower($node->pattern)] = $glob;
                }
            } else {
                $lookup['globs'][] = new Glob($node->type, $node->weight, $node->pattern, $node->caseSensitive);
            }
        }

        $compareGlobs = self::compareGlobs(...);
        foreach (array_keys($lookup['caseSensitiveExtensions']) as $ext) {
            usort($lookup['caseSensitiveExtensions'][$ext], $compareGlobs);
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

    /**
     * @param MagicNode[] $rules
     */
    private function createMagicLookup(array $rules): array
    {
        usort($rules, fn(MagicNode $a, MagicNode $b) => $b->priority <=> $a->priority ?: $a->type <=> $b->type);
        $lookupBufferSize = 0;
        foreach ($rules as $rule) {
            $lookupBufferSize = max($lookupBufferSize, $rule->getMaxLength());
        }
        return [
            'lookupBufferSize' => $lookupBufferSize,
            'rules' => $rules,
        ];
    }

    private function reprString(string $value): string
    {
        if (!$value || ctype_print($value)) {
            return var_export($value, true);
        }
        $output = '';
        for ($i = 0; $i < \strlen($value); $i++) {
            $c = $value[$i];
            $o = \ord($c);
            if ($o <= 0x1F || $o >= 0x7F) {
                $output .= match ($o) {
                    0x09 => '\t',
                    0x0A => '\n',
                    0x0B => '\v',
                    0x0C => '\f',
                    0x0D => '\r',
                    default => sprintf('\x%02X', $o),
                };
            } else {
                $output .= match ($c) {
                    '\\' => '\\\\',
                    '"' => '\"',
                    '$' => '\$',
                    default => $c,
                };
            }
        }
        return sprintf('"%s"', $output);
    }
}
