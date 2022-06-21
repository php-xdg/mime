<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Runtime;

use ju1ius\XdgMime\MimeDatabaseInterface;

/**
 * @internal
 */
final class MimeDatabase implements MimeDatabaseInterface
{
    use MimeDatabaseTrait;

    public function __construct(
        private AliasesDatabase $aliases,
        private SubclassesDatabase $subclasses,
        private GlobsDatabase $globs,
        private MagicDatabase $magic,
        private TreeMagicDatabase $treeMagic,
        private IconsDatabase $icons,
        private XmlNamespacesDatabase $xmlNamespaces,
    ) {
    }
}
