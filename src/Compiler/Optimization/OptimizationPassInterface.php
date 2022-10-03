<?php declare(strict_types=1);

namespace Xdg\Mime\Compiler\Optimization;

use Xdg\Mime\Parser\AST\MimeInfoNode;

/**
 * @internal
 */
interface OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode;
}
