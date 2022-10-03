<?php declare(strict_types=1);

use Symfony\Component\Filesystem\Filesystem;
use Xdg\Mime\MimeDatabaseGenerator;

$root = \dirname(__DIR__);
$mimeInfoSrc = $root . '/resources/shared-mime-info/data/freedesktop.org.xml.in';
$mimeInfoDest = $root . '/src/Resources/mime-info/freedesktop.org.xml';
$outputDir = $root . '/src/Resources/db';

require $root . '/vendor/autoload.php';

$fs = new Filesystem();
$fs->copy($mimeInfoSrc, $mimeInfoDest);

MimeDatabaseGenerator::new()
    ->useXdgDirectories(false)
    ->addCustomPaths($root . '/src/Resources/mime-info')
    ->generate($outputDir)
;
