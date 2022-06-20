<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Parser\Exception;

final class ParseError extends \RuntimeException
{
    public static function fromLibXml(\LibXMLError $error): self
    {
        $message = trim($error->message);
        if ($file = $error->file) {
            $message .= sprintf(' in %s', $file);
        }
        if ($line = $error->line) {
            $message .= sprintf('on line %d', $line);
        }

        return new self($message, $error->code);
    }
}
