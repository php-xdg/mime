<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\SharedMimeInfo;

use Symfony\Component\Filesystem\Path;

final class TreeMagicListParser
{
    public function parse(string $path): iterable
    {
        foreach (file($path, \FILE_IGNORE_NEW_LINES|\FILE_SKIP_EMPTY_LINES) as $line) {
            if (str_starts_with($line, '#')) {
                continue;
            }
            $parts = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
            if ($xFail = $parts[0] === 'x') {
                array_shift($parts);
            }
            $filename = array_shift($parts);
            if (Path::isRelative($filename)) {
                $filename = Path::makeAbsolute($filename, \dirname($path));
            }
            yield new TreeMagicTestDTO($filename, $parts, $xFail);
        }
    }
}
