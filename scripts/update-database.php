<?php declare(strict_types=1);

const UPSTREAM_URL = 'https://gitlab.freedesktop.org/xdg/shared-mime-info/-/raw/master/data/freedesktop.org.xml.in';

$root = \dirname(__DIR__);
$destFile = $root . '/src/Resources/mime-info/freedesktop.org.xml';

if (false === $fp = fopen(UPSTREAM_URL, 'r')) {
    exit(1);
}
file_put_contents($destFile, $fp);

require __DIR__ . '/compile-database.php';

exit(0);
