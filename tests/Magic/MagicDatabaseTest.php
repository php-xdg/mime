<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Test\Magic;

use ju1ius\XDGMime\Magic\MagicDatabase;
use ju1ius\XDGMime\Magic\MagicDatabaseBuilder;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class MagicDatabaseTest extends TestCase
{
    public function testPythonMagicRules(): void
    {
        $db = $this->buildDatabase('python.magic');
        $result = $db->match($this->getTestFile('python-app'));
        Assert::assertSame('text/x-python', (string)$result);
    }

    private function buildDatabase(string $path): MagicDatabase
    {
        $builder = new MagicDatabaseBuilder();
        return $builder->build([
            __DIR__ . '/../Resources/databases/' . $path,
        ]);
    }

    private function getTestFile(string $path): string
    {
        return __DIR__ . '/../Resources/files/' . $path;
    }
}
