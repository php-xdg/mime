<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Test\Runtime;

use ju1ius\XdgMime\Runtime\MagicRegex;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

final class MagicRegexTest extends TestCase
{
    /**
     * @dataProvider matchesProvider
     */
    public function testMatches(MagicRegex $rule, string $input, bool $expected): void
    {
        Assert::assertSame($expected, $rule->matches($input, 0));
    }

    public function matchesProvider(): iterable
    {
        yield 'simple match at offset' => [
            new MagicRegex('/(?n)\A.{3}foo/'),
            'xxxfoo',
            true,
        ];
        yield 'child rule with different offset' => [
            new MagicRegex('/(?n)\A.{3}foo/', [
                new MagicRegex('/(?n)\Aqux/'),
                new MagicRegex('/(?n)\Abar/'),
            ]),
            'barfoo',
            true,
        ];
        yield 'failing child rule' => [
            new MagicRegex('/(?n)\A.{3}foo/', [
                new MagicRegex('/(?n)\Aqux/'),
            ]),
            'barfoo',
            false,
        ];
    }
}
