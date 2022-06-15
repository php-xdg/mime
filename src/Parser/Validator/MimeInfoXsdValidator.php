<?php declare(strict_types=1);

namespace ju1ius\XDGMime\Parser\Validator;

/**
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
