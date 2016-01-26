<?php

namespace ju1ius\XDGMime\Test\Magic;


use ju1ius\XDGMime\Magic\MagicDatabaseBuilder;

class MagicDatabaseTest extends \PHPUnit_Framework_TestCase
{
    private function buildDatabase($path)
    {
        $builder = new MagicDatabaseBuilder();
        return $builder->build([
            __DIR__.'/../Resources/databases/'.$path
        ]);
    }

    private function getTestFile($path)
    {
        return __DIR__.'/../Resources/files/'.$path;
    }

    public function testPythonMagicRules()
    {
        $db = $this->buildDatabase('python.magic');
        $result = $db->match($this->getTestFile('python-app'));
        $this->assertEquals('text/x-python', (string)$result);
    }
}
