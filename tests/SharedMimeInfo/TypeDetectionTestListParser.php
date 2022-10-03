<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\SharedMimeInfo;

use Symfony\Component\Filesystem\Path;

/**
 * Regression tests file format for shared-mime-info and xdgmime.
 *
 * Syntax: <filename> <expected mimetype> [NDF]
 * where N can be 'x' if the lookup by filename is expected to fail
 *        D can be 'x' if the lookup by file data is expected to fail
 *        F can be 'x' if the lookup by actual file (using both name and contents) is expected to fail
 *  Use 'o' to express the opposite, i.e. no expected failure for this kind of lookup.
 *  Example: 'ox' means N=o D=x (and F is 'o', implicitly), lookup by data should fail.
 */
final class TypeDetectionTestListParser
{
    public function __construct(
        private readonly string $resourcePath,
    ) {
    }

    /**
     * @return iterable<TypeDetectionTestDTO>
     */
    public function parse(string $path): iterable
    {
        foreach (file($path, \FILE_IGNORE_NEW_LINES|\FILE_SKIP_EMPTY_LINES) as $line) {
            if (str_starts_with($line, '#')) {
                continue;
            }
            $parts = preg_split('/\s+/', $line, 3, PREG_SPLIT_NO_EMPTY);
            [$filename, $expected] = $parts;
            if (Path::isRelative($filename)) {
                $filename = Path::makeAbsolute($filename, $this->resourcePath);
            }
            $flags = $this->parseFlags($parts[2] ?? '');
            yield new TypeDetectionTestDTO($filename, $expected, ...$flags);
        }
    }

    /**
     * @return array{bool, bool, bool}
     */
    private function parseFlags(string $input = ''): array
    {
        $input = substr(str_pad($input, 3, 'o'), 0, 3);
        return array_map(fn($f) => $f === 'x', str_split($input));
    }
}
