<?php declare(strict_types=1);

namespace Xdg\Mime\Parser\Validator;

/**
 * @internal
 */
final class MimeInfoRngValidator extends AbstractSchemaValidator
{
    private const SCHEMA = __DIR__ . '/../../Resources/schemas/shared-mime-info.rng';

    protected function doValidate(\DOMDocument $document): void
    {
        $document->relaxNGValidate(self::SCHEMA);
    }
}
