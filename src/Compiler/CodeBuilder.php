<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Compiler;

use Stringable;

final class CodeBuilder implements Stringable
{
    /** @var string[] */
    private array $imports = [];
    private string $header = '';
    private string $body = '';

    public function __construct(
        private int $indentLevel = 0,
        private readonly string $indentString = '    ',
    ) {
    }

    public static function forFile(bool $strictTypes = true): self
    {
        $code = new self();
        $code->header .= '<?php';
        if ($strictTypes) {
            $code->header .= ' declare(strict_types=1);';
        }
        return $code;
    }

    public function indent(int $n = 1): self
    {
        $this->indentLevel = max(0, $this->indentLevel + $n);
        return $this;
    }

    public function dedent(int $n = 1): self
    {
        $this->indentLevel = max(0, $this->indentLevel - $n);
        return $this;
    }

    public function raw(string $value): self
    {
        $this->body .= $value;
        return $this;
    }

    public function write(string $value): self
    {
        $indent = str_repeat($this->indentString, $this->indentLevel);
        $this->body .= $indent . $value;
        return $this;
    }

    public function writeln(string ...$lines): self
    {
        $indent = str_repeat($this->indentString, $this->indentLevel);
        foreach ($lines as $line) {
            $this->body .= $indent . $line . "\n";
        }
        return $this;
    }

    public function join(string $glue, iterable $values, callable $cb): self
    {
        $first = true;
        foreach ($values as $k => $v) {
            if (!$first) {
                $this->raw($glue);
            }
            $first = false;
            $cb($v, $k, $this);
        }
        return $this;
    }

    public function new(string $fqcn): self
    {
        $this->imports[$fqcn] = true;
        $this->raw('new ')->className($fqcn);
        return $this;
    }

    public function use(string ...$classes): self
    {
        foreach ($classes as $class) {
            $this->imports[$class] = true;
        }

        return $this;
    }

    public function className(string $class): self
    {
        $this->body .= match ($p = strrpos($class, '\\')) {
            false => $class,
            default => substr($class, $p + 1),
        };
        return $this;
    }

    public function repr(mixed $value): self
    {
        if (\is_int($value) || \is_float($value)) {
            $this->raw((string)$value);
        } elseif (\is_null($value)) {
            $this->raw('null');
        } elseif (\is_bool($value)) {
            $this->raw($value ? 'true' : 'false');
        } elseif (\is_array($value)) {
            $this->raw('[');
            if (array_is_list($value)) {
                $this->join(', ', $value, fn($v) => $this->repr($v));
            } else {
                $this->join(', ', $value, fn($v, $k) => $this->repr($k)->raw(' => ')->repr($v));
            }
            $this->raw(']');
        } else {
            $this->string($value);
        }

        return $this;
    }

    public function string(string $value): self
    {
        if (!$value || ctype_print($value)) {
            $this->body .= var_export($value, true);
            return $this;
        }
        $output = '';
        for ($i = 0; $i < \strlen($value); $i++) {
            $c = $value[$i];
            $o = \ord($c);
            if ($o <= 0x1F || $o >= 0x7F) {
                $output .= match ($o) {
                    0x09 => '\t',
                    0x0A => '\n',
                    0x0B => '\v',
                    0x0C => '\f',
                    0x0D => '\r',
                    default => sprintf('\x%02X', $o),
                };
            } else {
                $output .= match ($c) {
                    '\\' => '\\\\',
                    '"' => '\"',
                    '$' => '\$',
                    default => $c,
                };
            }
        }
        $this->body .= '"' . $output . '"';
        return $this;
    }

    public function getSource(): string
    {
        if ($header = $this->header) {
            $header .= "\n\n";
        }
        if ($this->imports) {
            ksort($this->imports, \SORT_STRING);
            foreach (array_keys($this->imports) as $import) {
                $header .= sprintf("use %s;\n", $import);
            }
            $header .= "\n";
        }
        return $header . $this->body;
    }

    public function __toString(): string
    {
        return $this->getSource();
    }
}
