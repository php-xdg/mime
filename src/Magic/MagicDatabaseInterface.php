<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Magic;

interface MagicDatabaseInterface
{
    /**
     * Read data from the file and do magic sniffing on it.
     *
     * `$maxPriority` & `$minPriority` can be used to specify the maximum & minimum priority rules to look for.
     *
     * `$possible` can be a list of mimetypes to check, or null (the default) to check all mimetypes until one matches.
     *
     * Returns the MIME type found, or null if no entries match.
     * Raises IOError if the file can't be opened.
     */
    public function match(string $path, int $maxPriority = 100, int $minPriority = 0, ?array $possible = null): ?string;

    public function matchData(
        string $data,
        int $maxPriority = 100,
        int $minPriority = 0,
        ?array $possible = null
    ): ?string;
}
