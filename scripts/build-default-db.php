<?php declare(strict_types=1);

use ju1ius\XdgMime\MimeDatabaseGenerator;

require __DIR__ . '/../vendor/autoload.php';

$xmlFile = __DIR__ . '/../resources/shared-mime-info/data/freedesktop.org.xml.in';
$outputDir = __DIR__ . '/../src/Resources/db';

MimeDatabaseGenerator::new()
    ->useXdgDirectories(false)
    ->addCustomPaths($xmlFile)
    ->generate($outputDir)
;
