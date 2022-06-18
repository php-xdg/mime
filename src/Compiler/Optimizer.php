<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler;

use ju1ius\XDGMime\Compiler\Optimization\AliasLookupPass;
use ju1ius\XDGMime\Compiler\Optimization\GlobsLookupPass;
use ju1ius\XDGMime\Compiler\Optimization\HierarchyLookupPass;
use ju1ius\XDGMime\Compiler\Optimization\Magic\CombineAndMatches;
use ju1ius\XDGMime\Compiler\Optimization\Magic\CombineOrMatches;
use ju1ius\XDGMime\Compiler\Optimization\Magic\ConvertRangedMatch;
use ju1ius\XDGMime\Compiler\Optimization\Magic\RegExpManipulator;
use ju1ius\XDGMime\Compiler\Optimization\MagicLookupPass;
use ju1ius\XDGMime\Compiler\Optimization\MagicRulesOptimizationPass;
use ju1ius\XDGMime\Compiler\Optimization\OptimizationPassInterface;
use ju1ius\XDGMime\Compiler\Optimization\TreeMagicLookupPass;
use ju1ius\XDGMime\Parser\AST\MimeInfoNode;

final class Optimizer
{
    /**
     * @var OptimizationPassInterface[]
     */
    private array $passes = [];

    public static function create(): self
    {
        $manipulator = new RegExpManipulator();
        return (new self())
            ->add(
                new AliasLookupPass(),
                new HierarchyLookupPass(),
                new GlobsLookupPass(),
                new MagicLookupPass(),
                new TreeMagicLookupPass(),
                new MagicRulesOptimizationPass([
                    new ConvertRangedMatch($manipulator),
                    new CombineOrMatches($manipulator),
                    new CombineAndMatches($manipulator),
                ]),
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
