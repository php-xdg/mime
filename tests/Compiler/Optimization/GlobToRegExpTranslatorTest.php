<?php declare(strict_types=1);

namespace Xdg\Mime\Tests\Compiler\Optimization;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Xdg\Mime\Compiler\Optimization\Glob\GlobToRegExpTranslator;
use Xdg\Mime\Compiler\Optimization\Glob\GlobTranslationError;

final class GlobToRegExpTranslatorTest extends TestCase
{
    /**
     * @dataProvider translateProvider
     */
    public function testTranslate(string $glob, string $expected): void
    {
        $translator = new GlobToRegExpTranslator('~');
        Assert::assertSame($expected, $translator->translate($glob));
    }

    public function translateProvider(): iterable
    {
        yield ['*.txt', '.*\.txt'];
        yield ['\*.txt', '\*\.txt'];
        yield ['a?b', 'a.b'];
        yield ['a\?b', 'a\?b'];
        yield ['[a-z]', '[a-z]'];
        yield ['\[a-z]', '\[a\-z\]'];
        yield ['[]]', '[]]'];
        yield ['[0-9[:lower:]]', '[0-9[:lower:]]'];
        yield ['[!0-9]', '[^0-9]'];
        yield ['[^0-9]', '[^0-9]'];
        yield ['a[b', 'a\[b'];
    }

    /**
     * @dataProvider translationErrorProvider
     */
    public function testTranslationError(string $glob, ?string $message = null): void
    {
        $this->expectException(GlobTranslationError::class);
        if ($message) {
            $this->expectExceptionMessage($message);
        }
        $translator = new GlobToRegExpTranslator('~');
        $translator->translate($glob);
    }

    public function translationErrorProvider(): iterable
    {
        yield ['[-0--]', 'Compilation failed: range out of order in character class'];
    }
}
