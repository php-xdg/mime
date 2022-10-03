<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Compiler;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Compiler\CodeBuilder;

final class CodeBuilderTest extends TestCase
{
    /**
     * @dataProvider indentationProvider
     */
    public function testIndentation(CodeBuilder $code, string $expected): void
    {
        Assert::assertSame($expected, (string)$code);
    }

    public function indentationProvider(): \Traversable
    {
        yield 'raw() does not use indentation' => [
            CodeBuilder::create()->indent()->raw('foo'),
            'foo',
        ];
        yield 'write() uses indentation' => [
            CodeBuilder::create()->indent()->write('foo'),
            '    foo',
        ];
        yield 'writeln() uses indentation' => [
            CodeBuilder::create()->indent()->writeln('foo'),
            "    foo\n",
        ];
        yield 'dedent() decreases indentation' => [
            CodeBuilder::create()->indent()->writeln('a')->dedent()->writeln('b'),
            "    a\nb\n",
        ];
        yield 'indentation cannot be negative' => [
            CodeBuilder::create()->indent(-2)->writeln('a')->dedent(24)->writeln('b'),
            "a\nb\n",
        ];
    }

    public function testJoin(): void
    {
        $code = CodeBuilder::create()
            ->join(', ', ['a', 'b', 'c'], fn($v, $k, $code) => $code->raw((string)$k)->raw(':')->raw($v))
            ->getSource()
        ;
        Assert::assertSame('0:a, 1:b, 2:c', $code);
    }

    /**
     * @dataProvider stringRepresentationProvider
     */
    public function testStringRepresentation(string $input, string $expected): void
    {
        $code = CodeBuilder::create()->string($input)->getSource();
        Assert::assertSame($expected, $code);
    }

    public function stringRepresentationProvider(): \Traversable
    {
        yield 'empty string' => ['', "''"];
        yield 'printable ASCII' => ['foo bar', "'foo bar'"];
        yield 'printable w/ $' => ['foo $bar', '\'foo $bar\''];
        yield 'PHP control chars' => ["\t\n\v\f\r", '"\t\n\v\f\r"'];
        yield 'escapes quotes' => ["\t\"foo\"bar", '"\t\"foo\"bar"'];
        yield 'escapes $and backslash' => ["\t\\foo \$bar", '"\t\\\\foo \$bar"'];
        yield 'escapes bytes' => ["\x00\xFF", '"\x00\xFF"'];
    }

    /**
     * @dataProvider integerRepresentationProvider
     */
    public function testIntegerRepresentation(int $input, int $base, string $expected): void
    {
        $code = CodeBuilder::create()->int($input, $base)->getSource();
        Assert::assertSame($expected, $code);
    }

    public function integerRepresentationProvider(): \Traversable
    {
        yield '0 in binary' => [0, 2, '0'];
        yield '0 in octal' => [0, 8, '0'];
        yield '0 in hexadecimal' => [0, 16, '0'];
        yield '42 in base 10' => [42, 10, '42'];
        yield '42 in binary' => [42, 2, '0b101010'];
        yield '42 in octal' => [42, 8, '0o52'];
        yield '42 in hexadecimal' => [42, 16, '0x2A'];
    }

    /**
     * @dataProvider genericRepresentationProvider
     */
    public function testGenericRepresentation(mixed $input, string $expected): void
    {
        $code = CodeBuilder::create()->repr($input)->getSource();
        Assert::assertSame($expected, $code);
    }

    public function genericRepresentationProvider(): \Traversable
    {
        yield 'null' => [null, 'null'];
        yield 'int' => [42, '42'];
        yield 'float' => [1.5, '1.5'];
        yield 'true' => [true, 'true'];
        yield 'false' => [false, 'false'];
        yield 'string' => ['foobar', "'foobar'"];
        yield 'list of int' => [[1, 2, 3], '[1, 2, 3]'];
        yield 'list of string' => [['a', 'b', 'c'], "['a', 'b', 'c']"];
        yield 'list of list' => [[[1, 2], [3, 4]], '[[1, 2], [3, 4]]'];
        yield 'assoc' => [
            ['a' => 1, 'b' => 2, 'c' => 4],
            "['a' => 1, 'b' => 2, 'c' => 4]",
        ];
        yield 'assoc with integer keys' => [
            [666 => 'the beast', 42 => 'everything'],
            "[666 => 'the beast', 42 => 'everything']",
        ];
    }

    public function testFileHeader(): void
    {
        $code = CodeBuilder::forFile()->writeln('$foo = 42;')->getSource();
        $expected = <<<'PHP'
        <?php declare(strict_types=1);

        $foo = 42;

        PHP;
        Assert::assertSame($expected, $code);
    }

    public function testUse(): void
    {
        $code = CodeBuilder::create()
            ->writeln('qux(new Foo());')
            ->use('Foo', 'Bar', 'Baz', 'function qux')
            ->getSource();
        $expected = <<<'PHP'
        use Bar;
        use Baz;
        use Foo;
        use function qux;

        qux(new Foo());

        PHP;
        Assert::assertSame($expected, $code);
    }

    public function testClassName(): void
    {
        $code = CodeBuilder::create()
            ->className('\Foo\Bar')->raw("\n")
            ->className('\Baz', false)->raw("\n")
            ->className('finfo')->raw("\n")
            ->getSource();
        $expected = <<<'EOS'
        use \Foo\Bar;
        use finfo;

        Bar
        \Baz
        finfo

        EOS;
        Assert::assertSame($expected, $code);
    }

    public function testNew(): void
    {
        $code = CodeBuilder::create()
            ->new('Foo\Bar')->raw(";\n")
            ->new('Baz')->raw(";\n")
            ->new('stdClass')->raw(";\n")
            ->getSource();
        $expected = <<<'PHP'
        use Baz;
        use Foo\Bar;
        use stdClass;

        new Bar;
        new Baz;
        new stdClass;

        PHP;
        Assert::assertSame($expected, $code);
    }
}
