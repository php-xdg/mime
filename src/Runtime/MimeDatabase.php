<?php declare(strict_types=1);

namespace Xdg\Mime\Runtime;

use Xdg\Mime\MimeDatabaseInterface;

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
