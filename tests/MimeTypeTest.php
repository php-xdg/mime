<?php

namespace ju1ius\XDGMime\Test;

use ju1ius\XDGMime\MimeType;


class MimeTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testThatItParsesCorrectly()
    {
        $type = MimeType::create('text/plain');
        $this->assertEquals('text', $type->getMedia());
        $this->assertEquals('plain', $type->getSubtype());

        $type = MimeType::create('application/vnd.stuff.x-foo');
        $this->assertEquals('application', $type->getMedia());
        $this->assertEquals('vnd.stuff.x-foo', $type->getSubtype());
    }

    /**
     * @dataProvider invalidMimeTypeProvider
     *
     * @expectedException \ju1ius\XDGMime\InvalidMimeType
     */
    public function testThatItRaisesInvalidMimeType($mime)
    {
        MimeType::create($mime);
    }
    public function invalidMimeTypeProvider()
    {
        return [
            ['application'],
            ['application/foo/bar/baz']
        ];
    }

    public function testMimeTypeStrictEquality()
    {
        $this->assertEquals(MimeType::create('audio/mpeg'), MimeType::create('audio/mpeg'));
    }

    /**
     * @dataProvider toStringProvider
     */
    public function testThatItConvertsToString($mime)
    {
        $this->assertEquals($mime, (string)MimeType::create($mime));
    }
    public function toStringProvider()
    {
        return [
            ['inode/door'],
            ['application/vdn.foo-bar.x-baz']
        ];
    }

    public function testThatMimeTypesAreCaseInsensitive()
    {
        $type = MimeType::create('image/JPEG');
        $this->assertEquals('image', $type->getMedia());
        $this->assertEquals('jpeg', $type->getSubtype());
    }
}
