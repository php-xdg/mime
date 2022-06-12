<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\Compiler;

use ju1ius\XDGMime\Runtime\MimeDatabase;
use ju1ius\XDGMime\Test\ResourceHelper;
use ju1ius\XDGMime\Test\TestDatabaseFactory;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class MimeDatabaseCompilerTest extends TestCase
{
    public function testItCompilesDefaultDatabase(): void
    {
        $db = TestDatabaseFactory::createFromFile(
            ResourceHelper::getSharedMimeInfoPath('data/freedesktop.org.xml.in')
        );
        Assert::assertInstanceOf(MimeDatabase::class, $db);
    }
}
