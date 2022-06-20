<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler;

use ju1ius\XdgMime\Compiler\Optimization\Lookup\AliasLookupVisitor;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\GlobLookupVisitor;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\HierarchyLookupVisitor;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\IconLookupVisitor;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\MagicLookupVisitor;
use ju1ius\XdgMime\Compiler\Optimization\Lookup\TreeMagicLookupVisitor;
use ju1ius\XdgMime\Compiler\Optimization\Magic\CombineAndMatches;
use ju1ius\XdgMime\Compiler\Optimization\Magic\CombineOrMatches;
use ju1ius\XdgMime\Compiler\Optimization\Magic\ConvertExpensiveMatch;
use ju1ius\XdgMime\Compiler\Optimization\Magic\RegExpManipulator;
use ju1ius\XdgMime\Compiler\Optimization\MagicRulesOptimizationPass;
use ju1ius\XdgMime\Compiler\Optimization\OptimizationPassInterface;
use ju1ius\XdgMime\Compiler\Optimization\RecursivePass;
use ju1ius\XdgMime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
final class Optimizer
{
    /**
     * @var OptimizationPassInterface[]
     */
    private array $passes = [];

    public static function create(): self
    {
        $manipulator = new RegExpManipulator('~');
        return (new self())
            ->add(
                new RecursivePass(
                    new ConvertExpensiveMatch($manipulator),
                    new CombineOrMatches($manipulator),
                    new CombineAndMatches($manipulator),
                    //
                    new AliasLookupVisitor(),
                    new HierarchyLookupVisitor(),
                    new GlobLookupVisitor(),
                    new MagicLookupVisitor(),
                    new TreeMagicLookupVisitor(),
                    new IconLookupVisitor(),
                ),
            )
        ;
    }

    public function add(OptimizationPassInterface ...$passes): self
    {
        array_push($this->passes, ...$passes);

        return $this;
    }

    public function process(MimeInfoNode $info): MimeInfoNode
    {
        foreach ($this->passes as $pass) {
            $info = $pass->process($info);
        }

        return $info;
    }
}
