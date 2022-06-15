<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser;

use ju1ius\XDGMime\Parser\Exception\ParseError;

/**
 * @internal
 */
final class MimeInfoXSDValidator implements MimeInfoValidatorInterface
{
    private const SCHEMA = __DIR__ . '/../Resources/schemas/shared-mime-info.xsd';

    public function validate(\DOMDocument $document): void
    {
        $useInternalErrors = libxml_use_internal_errors(true);
        libxml_clear_errors();
        $document->schemaValidate(self::SCHEMA);
        $errors = libxml_get_errors();
        libxml_clear_errors();
        libxml_use_internal_errors($useInternalErrors);
        if ($errors) {
            $err = $errors[0];
            throw new ParseError(sprintf(
                '%s in %s:%d',
                $err->message,
                $err->file,
                $err->line,
            ));
        }
    }
}
