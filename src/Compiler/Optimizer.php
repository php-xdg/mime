<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler;

use Xdg\Mime\Compiler\Optimization\Glob\CombineExpensiveGlobs;
use Xdg\Mime\Compiler\Optimization\Lookup\PopulateAliasLookup;
use Xdg\Mime\Compiler\Optimization\Lookup\PopulateGlobLookup;
use Xdg\Mime\Compiler\Optimization\Lookup\PopulateHierarchyLookup;
use Xdg\Mime\Compiler\Optimization\Lookup\PopulateIconLookup;
use Xdg\Mime\Compiler\Optimization\Lookup\PopulateMagicLookup;
use Xdg\Mime\Compiler\Optimization\Lookup\PopulateTreeMagicLookup;
use Xdg\Mime\Compiler\Optimization\Lookup\PopulateXmlNamespaceLookup;
use Xdg\Mime\Compiler\Optimization\Magic\CombineAndMatches;
use Xdg\Mime\Compiler\Optimization\Magic\CombineOrMatches;
use Xdg\Mime\Compiler\Optimization\Magic\ConvertExpensiveMatch;
use Xdg\Mime\Compiler\Optimization\Magic\ConvertToMachineByteOrder;
use Xdg\Mime\Compiler\Optimization\Magic\RegExpManipulator;
use Xdg\Mime\Compiler\Optimization\OptimizationPassInterface;
use Xdg\Mime\Compiler\Optimization\RecursivePass;
use Xdg\Mime\Parser\AST\MimeInfoNode;
use Xdg\Mime\Utils\Bytes;

/**
 * @internal
 */
final class Optimizer
{
    /**
     * @var OptimizationPassInterface[]
     */
    private array $passes = [];

    public static function create(bool $optimize = true, bool $platformDependent = false): self
    {
        $optimizations = [
            new PopulateAliasLookup(),
            new PopulateHierarchyLookup(),
            new PopulateGlobLookup(),
            new PopulateMagicLookup(),
            new PopulateTreeMagicLookup(),
            new PopulateIconLookup(),
            new PopulateXmlNamespaceLookup(),
        ];

        if (!$optimize) {
            return (new self())->add(new RecursivePass(...$optimizations));
        }

        $manipulator = new RegExpManipulator('~');
        $optimizations = [
            new ConvertExpensiveMatch($manipulator),
            new CombineOrMatches($manipulator),
            new CombineAndMatches($manipulator),
            ...$optimizations,
            new CombineExpensiveGlobs(),
        ];

        if ($platformDependent) {
            $optimizations = [
                new ConvertToMachineByteOrder(Bytes::isLittleEndianPlatform()),
                ...$optimizations,
            ];
        }

        return (new self())->add(new RecursivePass(...$optimizations));
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
