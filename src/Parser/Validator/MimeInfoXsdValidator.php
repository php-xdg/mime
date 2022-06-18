<?php declare(strict_types=1);

namespace ju1ius\XdgMime\Parser\Validator;

/**
 * @deprecated: libxml2 does not support XML Schema 1.1,
 * which is required to fully validate the shared-mime-info XML files.
 * Use the provided RelaxNG schema instead.
 *
 * @internal
 */
final class MimeInfoXsdValidator extends AbstractSchemaValidator
{
    private const SCHEMA = __DIR__ . '/../../Resources/schemas/shared-mime-info.xsd';

    protected function doValidate(\DOMDocument $document): void
    {
        $document->schemaValidate(self::SCHEMA);
    }
}
