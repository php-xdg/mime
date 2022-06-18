<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Parser\Exception;

final class ParseError extends \RuntimeException
{
    public static function fromLibXml(\LibXMLError $error): self
    {
        $message = sprintf(
            '%s in %s:%d',
            trim($error->message),
            $error->file ?: '<string>',
            $error->line,
        );
        return new self($message, $error->code);
    }
}
