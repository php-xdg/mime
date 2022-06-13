<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Runtime;

final class MimeDatabase implements MimeDatabaseInterface
{
    use MimeDatabaseTrait;

    public function __construct(
        private AliasesDatabase $aliases,
        private SubclassesDatabase $subclasses,
        private GlobsDatabase $globs,
        private MagicDatabase $magic,
    ) {
    }
}
