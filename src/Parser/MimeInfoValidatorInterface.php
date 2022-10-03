<?php declare(strict_types=1);

namespace Xdg\Mime\Parser;

use Xdg\Mime\Parser\Exception\ParseError;

/**
 * @internal
 */
interface MimeInfoValidatorInterface
{
    /**
     * @throws ParseError when the document is invalid.
     */
    public function validate(\DOMDocument $document): void;
}
