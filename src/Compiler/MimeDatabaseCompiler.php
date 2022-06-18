<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler;

use ju1ius\XDGMime\Parser\AST\GlobNode;
use ju1ius\XDGMime\Parser\AST\MagicRegexMatchNode;
use ju1ius\XDGMime\Parser\AST\MagicRuleNode;
use ju1ius\XDGMime\Parser\AST\MagicMatchNode;
use ju1ius\XDGMime\Parser\AST\MimeInfoNode;
use ju1ius\XDGMime\Parser\AST\TreeMatchNode;
use ju1ius\XDGMime\Runtime\AliasesDatabase;
use ju1ius\XDGMime\Runtime\Glob;
use ju1ius\XDGMime\Runtime\GlobLiteral;
use ju1ius\XDGMime\Runtime\GlobsDatabase;
use ju1ius\XDGMime\Runtime\MagicDatabase;
use ju1ius\XDGMime\Runtime\MagicMatch;
use ju1ius\XDGMime\Runtime\MagicRegex;
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
        $info = Optimizer::create()->process($info);

        $code = new CodeBuilder();

        $this->compileEndiannessCheck($code);

        $code->write('return ')->new(MimeDatabase::class)->raw("(\n");
        $code->indent();

        $code->write('');
        $this->compileAliases($info, $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileSubClasses($info, $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileGlobs($info, $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileMagicRules($info, $code);
        $code->raw(",\n");

        $code->write('');
        $this->compileTreeMagicRules($info, $code);
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
        $info = Optimizer::create()->process($info);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileAliases($info, $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/aliases.php", $code);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileSubClasses($info, $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/subclasses.php", $code);

        $code = CodeBuilder::forFile()->write('return ');
        $this->compileGlobs($info, $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/globs.php", $code);

        $code = CodeBuilder::forFile();
        $this->compileEndiannessCheck($code);
        $code->write('return ');
        $this->compileMagicRules($info, $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/magic.php", $code);

        $code = CodeBuilder::forFile();
        $code->write('return ');
        $this->compileTreeMagicRules($info, $code);
        $code->raw(";\n");
        $this->fs->dumpFile("{$path}/treemagic.php", $code);
    }

    private function compileSubClasses(MimeInfoNode $info, CodeBuilder $code): void
    {
        $code
            ->new(SubclassesDatabase::class)->raw("([\n")
            ->indent()
            ->each($info->hierarchyLookup, fn($v, $k, $code) => $code->write('')->repr($k)->raw(' => ')->repr($v)->raw(",\n"))
            ->dedent()
            ->write('])')
        ;
    }

    private function compileAliases(MimeInfoNode $info, CodeBuilder $code): void
    {
        $code
            ->new(AliasesDatabase::class)->raw("([\n")
            ->indent()
            ->each($info->aliasLookup, fn($v, $k, $code) => $code->write('')->repr($k)->raw(' => ')->repr($v)->raw(",\n"))
            ->dedent()
            ->write('])')
        ;
    }

    private function compileGlobs(MimeInfoNode $info, CodeBuilder $code): void
    {
        $code->new(GlobsDatabase::class)->raw("(\n");
        $code->indent();
        $props = [
            'extensionGlobs' => 'extensions',
            'caseSensitiveExtensionGlobs' => 'caseSensitiveExtensions',
            'literalGlobs' => 'literals',
            'caseSensitiveLiteralGlobs' => 'caseSensitiveLiterals',
        ];
        foreach ($props as $lookupKey => $argName) {
            $hashMap = $info->{$lookupKey};
            if (!$hashMap) {
                $code->writeln(sprintf('%s: [],', $argName));
                continue;
            }
            $code->writeln(sprintf('%s: [', $argName))->indent();
            /** @var GlobNode|GlobNode[] $value */
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
        /** @var GlobNode $glob */
        foreach ($info->globs as $glob) {
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

    private function compileGlobLiteral(GlobNode $glob, CodeBuilder $code): void
    {
        $code->new(GlobLiteral::class)->raw('(')
            ->string($glob->type)->raw(', ')
            ->int($glob->weight)->raw(', ')
            ->int(\strlen($glob->pattern))
            ->raw(')')
        ;
    }

    private function compileMagicRules(MimeInfoNode $info, CodeBuilder $code): void
    {
        $lookupBufferSize = 0;
        if ($info->magic) {
            $lookupBufferSize = max(
                array_map(fn($r) => $r->getMaxLength(), $info->magic)
            );
        }

        $code->new(MagicDatabase::class)->raw("(\n");
        $code->indent();
        $code->writeln(sprintf('lookupBufferSize: %d,', $lookupBufferSize));

        $code->writeln('rules: [')->indent();
        foreach ($info->magic as $node) {
            $this->compileMagicRule($node, $code);
        }
        $code->dedent()->writeln('],');
        $code->dedent()->write(')');
    }

    private function compileMagicRule(MagicRuleNode $node, CodeBuilder $code): void
    {
        $code
            ->write('')
            ->new(MagicRule::class)->raw('(')
            ->string($node->type)->raw(', ')
            ->repr($node->priority)->raw(', ')
            ->repr($node->getMaxLength())->raw(', ')
            ->raw("[\n")->indent()
        ;
        foreach ($node->children as $match) {
            $code->write('');
            $this->compileMagicMatchNode($match, $code);
            $code->raw(",\n");
        }
        $code->dedent()->writeln(']),');
    }

    private function compileMagicMatchNode(MagicMatchNode $node, CodeBuilder $code): void
    {
        match ($node::class) {
            MagicRegexMatchNode::class => $this->compileMagicRegexMatch($node, $code),
            default => $this->compileMagicMatch($node, $code),
        };
    }

    private function compileMagicMatch(MagicMatchNode $match, CodeBuilder $code): void
    {
        $code
            ->new(MagicMatch::class)->raw('(')
            ->int($match->rangeStart)->raw(', ')
            ->int($match->rangeLength)->raw(', ')
            ->string($match->value)->raw(', ')
            ->string($match->mask)->raw(', ')
        ;
        if ($match->wordSize > 1) {
            $code->raw(sprintf('$swap|%d', $match->wordSize));
        } else {
            $code->raw('0');
        }
        if ($match->children) {
            $code
                ->raw(', [')
                ->join(', ', $match->children, fn($and) => $this->compileMagicMatchNode($and, $code))
                ->raw(']')
            ;
        }
        $code->raw(')');
    }

    private function compileMagicRegexMatch(MagicRegexMatchNode $node, CodeBuilder $code): void
    {
        $code
            ->new(MagicRegex::class)->raw('(')
            ->regex($node->compiledPattern)
        ;
        if ($node->children) {
            $code
                ->raw(', [')
                ->join(', ', $node->children, fn($and) => $this->compileMagicMatchNode($and, $code))
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

    private function compileTreeMagicRules(MimeInfoNode $info, CodeBuilder $code): void
    {
        $code->new(TreeMagicDatabase::class)->raw("([\n");
        $code->indent();
        foreach ($info->treeMagic as $rule) {
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
}
