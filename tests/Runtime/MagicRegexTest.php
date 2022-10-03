<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Runtime;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Runtime\MagicRegex;

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
