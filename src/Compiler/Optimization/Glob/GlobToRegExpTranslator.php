<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Compiler\Optimization\Glob;

/**
 * Translates a glob to a PCRE pattern (without delimiter).
 * This only handles globs suitable for `fnmatch()` without any flags.
 *
 * @see https://man7.org/linux/man-pages/man3/fnmatch.3.html
 * @see https://www.php.net/manual/en/function.fnmatch
 *
 * @internal
 */
final class GlobToRegExpTranslator
{
    public function __construct(
        private readonly string $delimiter = '/',
    ) {
    }

    public function translate(string $glob): string
    {
        $pattern = '';
        foreach ($this->tokenize($glob) as $type => $token) {
            $pattern .= match ($type) {
                '*' => '.*',
                '?' => '.',
                '[' => $this->translateCharacterClass($token['chars'], $token['negate']),
                'char' => preg_quote($token, $this->delimiter),
            };
        }
        return $this->validate($pattern);
    }

    private function validate(string $pattern): string
    {
        $p = sprintf('%s%s%s', $this->delimiter, $pattern, $this->delimiter);

        set_error_handler(static function(int $type, string $message) {
            throw new GlobTranslationError($message);
        });

        try {
            preg_match($p, '');
        } finally {
            restore_error_handler();
        }

        return $pattern;
    }

    private function translateCharacterClass(string $chars, bool $negate): string
    {
        return sprintf(
            '[%s%s]',
            $negate ? '^' : '',
            $chars,
        );
    }

    private function tokenize(string $glob): \Traversable
    {
        $i = 0;
        $l = \strlen($glob);
        while ($i < $l) {
            $c = $glob[$i];
            $lookahead = $glob[$i + 1] ?? '';
            switch ($c) {
                case '\\':
                    yield 'char' => $lookahead;
                    $i += 2;
                    break;
                case '[':
                    if ($token = $this->tokenizeCharacterClass($glob, $i)) {
                        yield '[' => $token;
                        $i += $token['length'];
                    } else {
                        yield 'char' => '[';
                        $i++;
                    }
                    break;
                case '*':
                    yield '*' => '*';
                    $i++;
                    break;
                case '?':
                    yield '?' => '?';
                    $i++;
                    break;
                default:
                    yield 'char' => $c;
                    $i++;
                    break;
            };
        }
    }

    /**
     * @see https://man7.org/linux/man-pages/man7/glob.7.html
     */
    private const CHAR_CLASS_RX = <<<'REGEXP'
    ~(?n)
        (?(DEFINE)
            (?<posix> \[: [a-z]+ :] )
        )
        \G
        \[
            (?<negate> [!^] )?
            (?<chars>
                ]?
                ( \\ . | (?&posix) | [^]] )*
            )
        ]
    ~x
    REGEXP;

    private function tokenizeCharacterClass(string $glob, int $pos): ?array
    {
        if (preg_match(self::CHAR_CLASS_RX, $glob, $m, \PREG_UNMATCHED_AS_NULL, $pos)) {
            return [
                'negate' => (bool)$m['negate'],
                'chars' => $m['chars'],
                'length' => \strlen($m[0]),
            ];
        }

        return null;
    }
}
