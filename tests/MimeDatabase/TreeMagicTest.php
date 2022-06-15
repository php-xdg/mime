<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\MimeDatabase;

use ju1ius\XDGMime\Test\MimeTypeAssert;
use ju1ius\XDGMime\Test\ResourceHelper;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\TestCase;

final class TreeMagicTest extends TestCase
{
    public function testTypeConstraints(): void
    {
        $db = TestDatabaseFactory::createFromString(<<<'XML'
        <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
            <mime-type type="x-content/foo">
                <treemagic>
                    <treematch path="dir" type="directory">
                        <treematch path="file" type="file">
                            <treematch path="link" type="link"/>
                        </treematch>
                    </treematch>
                </treemagic>
            </mime-type>
        </mime-info>
        XML);
        $type = $db->guessTypeForTree(ResourceHelper::getTreePath('type-constraints'));
        MimeTypeAssert::equals('x-content/foo', $type);
    }
}
