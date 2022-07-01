<?php declare(strict_types=1);

namespace ju1ius\XdgMime;

interface MimeDatabaseGeneratorInterface
{
    public function generate(string $outputDirectory): void;
}
