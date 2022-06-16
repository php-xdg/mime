<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler;

use ju1ius\XDGMime\Parser\Node\GlobNode;
use ju1ius\XDGMime\Parser\Node\MagicNode;
use ju1ius\XDGMime\Parser\Node\MatchNode;
use ju1ius\XDGMime\Parser\Node\MimeInfoNode;
use ju1ius\XDGMime\Parser\Node\TreeMagicNode;
use ju1ius\XDGMime\Parser\Node\TreeMatchNode;
use ju1ius\XDGMime\Parser\Node\TypeNode;
use ju1ius\XDGMime\Runtime\AliasesDatabase;
use ju1ius\XDGMime\Runtime\Glob;
use ju1ius\XDGMime\Runtime\GlobLiteral;
use ju1ius\XDGMime\Runtime\GlobsDatabase;
use ju1ius\XDGMime\Runtime\MagicDatabase;
use ju1ius\XDGMime\Runtime\MagicMatch;
use ju1ius\XDGMime\Runtime\MagicRule;
use ju1ius\XDGMime\Runtime\MimeDatabase;
use ju1ius\XDGMime\Runtime\SubclassesDatabase;
use ju1ius\XDGMime\Runtime\TreeMagicDatabase;
use ju1ius\XDGMime\Runtime\TreeMagicMatch;
use ju1ius\XDGMime\Runtime\TreeMagicRule;
use ju1ius\XDGMime\Utils\Bytes;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @internal
 */
final class MimeDatabaseCompiler
{
    private readonly Filesystem $fs;

    public function __construct()
    {
        $this->fs = new Filesystem();
    }

    public function compileToString(MimeInfoNode $info): string
    {
        $lookup = $this->createLookup($info);

        $code = new CodeBuilder();

        $this->compileEndiannessCheck($code);

        $code->write('return ')->new(MimeDatabase::class)->raw("(\n");
        $code->indent();

        $code->write('');
        $this->compileAliases($lookup['aliases'], $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileSubClasses($lookup['subclasses'], $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileGlobs($lookup['globs'], $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileMagicRules($lookup['magic'], $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileTreeMagicRules($lookup['treemagic'], $code);
        $code->raw(",\n");

        $code->dedent()->writeln(');');

        return (string)$code;
    }

    public function compileToFile(MimeInfoNode $info, string $path): void
    {
        $code = CodeBuilder::forFile()
            ->raw($this->compileToString($info))
        ;
        $this->fs->dumpFile($path, $code);
    }

    public function compileToDirectory(MimeInfoNode $info, string $path): void
    {
        $lookup = $this->createLookup($info);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileAliases($lookup['aliases'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/aliases.php", $code);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileSubClasses($lookup['subclasses'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/subclasses.php", $code);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileGlobs($lookup['globs'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/globs.php", $code);

        $code = CodeBuilder::forFile();
        $this->compileEndiannessCheck($code);
        $code->write('return ');
        $this->compileMagicRules($lookup['magic'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/magic.php", $code);

        $code = CodeBuilder::forFile();
        $code->write('return ');
        $this->compileTreeMagicRules($lookup['treemagic'], $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/treemagic.php", $code);
    }

    private function createLookup(MimeInfoNode $info): array
    {
        $aliases = [];
        $subclasses = [];
        $globs = [];
        $magicRules = [];
        $treeMagicRules = [];

        foreach ($info->children as $type) {
            if ($type->subclassOf) {
                $subclasses[$type->name] = $type->subclassOf;
            }
            foreach ($type->aliases as $alias) {
                $aliases[$alias] = $type->name;
            }
            foreach ($type->globs as $glob) {
                $globs[] = $glob;
            }
            foreach ($type->magic as $rule) {
                $magicRules[] = $rule;
            }
            foreach ($type->treeMagic as $rule) {
                $treeMagicRules[] = $rule;
            }
        }

        return [
            'subclasses' => $subclasses,
            'aliases' => $aliases,
            'globs' => $this->createGlobLookup($globs),
            'magic' => $this->createMagicLookup($magicRules),
            'treemagic' => $this->createTreeMagicLookup($treeMagicRules),
        ];
    }

    private function compileSubClasses(array $lookup, CodeBuilder $code): void
    {
        $code
            ->new(SubclassesDatabase::class)->raw("([\n")
            ->indent()
            ->each($lookup, fn($v, $k, $code) => $code->write('')->repr($k)->raw(' => ')->repr($v)->raw(",\n"))
            ->dedent()
            ->write('])')
        ;
    }

    private function compileAliases(array $lookup, CodeBuilder $code): void
    {
        $code
            ->new(AliasesDatabase::class)->raw("([\n")
            ->indent()
            ->each($lookup, fn($v, $k, $code) => $code->write('')->repr($k)->raw(' => ')->repr($v)->raw(",\n"))
            ->dedent()
            ->write('])')
        ;
    }

    private function compileGlobs(array $lookup, CodeBuilder $code): void
    {
        $code->new(GlobsDatabase::class)->raw("(\n");
        $code->indent();
        $literalKeys = [
            'extensions',
            'caseSensitiveExtensions',
            'literals',
            'caseSensitiveLiterals',
        ];
        foreach ($literalKeys as $lookupKey) {
            $hashMap = $lookup[$lookupKey];
            if (!$hashMap) {
                $code->writeln(sprintf('%s: [],', $lookupKey));
                continue;
            }
            $code->writeln(sprintf('%s: [', $lookupKey))->indent();
            /** @var GlobLiteral|GlobLiteral[] $value */
            foreach ($hashMap as $key => $value) {
                $code->write('')->string((string)$key)->raw(' => ');
                if (\is_array($value)) {
                    $code
                        ->raw('[')
                        ->join(', ', $value, fn($v) => $this->compileGlobLiteral($v, $code))
                        ->raw(']')
                    ;
                } else {
                    $this->compileGlobLiteral($value, $code);
                }
                $code->raw(",\n");
            }
            $code->dedent()->writeln('],');
        }

        $code->writeln('globs: [')->indent();
        /** @var Glob $glob */
        foreach ($lookup['globs'] as $glob) {
            $code->write('')->new(Glob::class)->raw('(')
                ->string($glob->type)->raw(', ')
                ->repr($glob->weight)->raw(', ')
                ->string($glob->pattern)->raw(', ')
                ->repr($glob->caseSensitive)
                ->raw("),\n")
            ;
        }
        $code->dedent()->writeln('],')->dedent()->write(')');
    }

    private function compileGlobLiteral(GlobLiteral $glob, CodeBuilder $code): void
    {
        $code->new(GlobLiteral::class)->raw('(')
            ->string($glob->type)->raw(', ')
            ->raw("{$glob->weight}, {$glob->length}")
            ->raw(')')
        ;
    }

    private function compileMagicRules(array $lookup, CodeBuilder $code): void
    {
        $code->new(MagicDatabase::class)->raw("(\n");
        $code->indent();
        $code->writeln(sprintf('lookupBufferSize: %d,', $lookup['lookupBufferSize']));

        $code->writeln('rules: [')->indent();
        /** @var MagicNode $rule */
        foreach ($lookup['rules'] as $rule) {
            $code
                ->write('')
                ->new(MagicRule::class)->raw('(')
                ->string($rule->type)->raw(', ')
                ->repr($rule->priority)->raw(', ')
                ->raw("[\n")
                ->indent()
            ;
            foreach ($rule->matches as $match) {
                $code->write('');
                $this->compileMagicMatch($match, $code);
                $code->raw(",\n");
            }
            $code->dedent()->writeln(']),');
        }
        $code->dedent()->writeln('],');
        $code->dedent()->write(')');
    }

    private function compileMagicMatch(MatchNode $match, CodeBuilder $code): void
    {
        $code
            ->new(MagicMatch::class)->raw('(')
            ->raw("{$match->start}, {$match->end}, ")
            ->string($match->value)->raw(', ')
            ->string($match->mask)->raw(', ')
        ;
        if ($match->wordSize > 1) {
            $code->raw(sprintf('%d|$swap', $match->wordSize));
        } else {
            $code->raw('0');
        }
        if ($match->children) {
            $code
                ->raw(', [')
                ->join(', ', $match->children, fn($and) => $this->compileMagicMatch($and, $code))
                ->raw(']')
            ;
        }
        $code->raw(')');
    }

    private function compileEndiannessCheck(CodeBuilder $code): void
    {
        $code
            ->write('$swap = ')
            ->className(Bytes::class)
            ->raw("::isLittleEndianPlatform() ? 1 : 0;\n")
            ->writeln('')
        ;
    }

    private function compileTreeMagicRules(array $lookup, CodeBuilder $code): void
    {
        $code->new(TreeMagicDatabase::class)->raw("([\n");
        $code->indent();
        /** @var TreeMagicNode $rule */
        foreach ($lookup as $rule) {
            $code->write('')->new(TreeMagicRule::class)->raw('(');
            $code
                ->string($rule->type)->raw(', ')
                ->repr($rule->priority)->raw(", [\n")
                ->indent()
            ;
            foreach ($rule->children as $match) {
                $code->write('');
                $this->compileTreeMagicMatch($match, $code);
                $code->raw(",\n");
            }
            $code->dedent()->writeln(']),');
        }
        $code->dedent()->write('])');
    }

    private function compileTreeMagicMatch(TreeMatchNode $match, CodeBuilder $code): void
    {
        $code
            ->new(TreeMagicMatch::class)->raw('(')
            ->string($match->path)->raw(', ')
            ->int($match->flags)->raw(', ')
            ->repr($match->mimeType)
        ;
        if ($match->children) {
            $code->raw(', [');
            $code->join(', ', $match->children, fn($m) => $this->compileTreeMagicMatch($m, $code));
            $code->raw(']');
        }
        $code->raw(')');
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

    /**
     * @param TreeMagicNode[] $rules
     *
     * @return TreeMagicNode[]
     */
    private function createTreeMagicLookup(array $rules): array
    {
        usort($rules, fn(TreeMagicNode $a, TreeMagicNode $b) => $b->priority <=> $a->priority ?: $a->type <=> $b->type);
        return $rules;
    }
}
