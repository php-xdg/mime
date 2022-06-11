<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\MimeDatabase;

use ju1ius\XDGMime\MimeType;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class CanonicalTypeTest extends TestCase
{
    public function testGetCanonicalType(): void
    {
        $xml = <<<'XML'
        <mime-info xmlns="http://www.freedesktop.org/standards/shared-mime-info">
            <mime-type type="application/x-foo">
                <alias type="text/x-foo"/>
                <alias type="application/x-foobar"/>
            </mime-type>
        </mime-info>
        XML;
        $db = TestDatabaseFactory::createFromString($xml);
        $appFoo = MimeType::of('application/x-foo');
        $textFoo = MimeType::of('text/x-foo');
        Assert::assertSame($appFoo, $db->getCanonicalType($appFoo));
        Assert::assertSame($appFoo, $db->getCanonicalType($textFoo));
    }
}
