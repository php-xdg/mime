<?php declare(strict_types=1);

use Xdg\Mime\MimeDatabaseGenerator;

require_once __DIR__ . '/../vendor/autoload.php';

$root = \dirname(__DIR__);
MimeDatabaseGenerator::new()
    ->useXdgDirectories(false)
    ->addCustomPaths("{$root}/src/Resources/mime-info")
    ->generate("{$root}/src/Resources/db")
;
