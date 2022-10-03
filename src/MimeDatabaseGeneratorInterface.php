<?php declare(strict_types=1);

namespace Xdg\Mime;

interface MimeDatabaseGeneratorInterface
{
    public function generate(string $outputDirectory): void;
}
