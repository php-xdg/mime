<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler\Optimization;

use ju1ius\XDGMime\Parser\Node\MimeInfoNode;

/**
 * @internal
 */
interface OptimizationPassInterface
{
    public function process(MimeInfoNode $info): MimeInfoNode;
}
