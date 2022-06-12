<?php declare(strict_types=1);

use ju1ius\XDGMime\Compiler\MimeDatabaseCompiler;
use ju1ius\XDGMime\Parser\MimeDatabaseParser;

require __DIR__ . '/../vendor/autoload.php';

$xmlFile = __DIR__ . '/../resources/shared-mime-info/data/freedesktop.org.xml.in';
$outputDir = __DIR__ . '/../src/Resources/db';

if (!is_dir($outputDir)) {
    mkdir($outputDir, 0o755, true);
}
$parser = new MimeDatabaseParser();
$compiler = new MimeDatabaseCompiler();
$compiler->compileToDirectory(
    $parser->parse($xmlFile),
    $outputDir,
);
