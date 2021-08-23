<?php

namespace sinri\ark\email\exception;

use sinri\ark\core\exception\ArkNestedException;
use sinri\ark\core\exception\ArkNestedExceptionTrait;
use Throwable;

/**
 * @since 1.4.0
 */
class ArkMailException extends \Exception
{
    use ArkNestedExceptionTrait;

    /**
     * OctetDatabaseQueryException constructor.
     * @param Throwable|null $previous
     * @param string $message
     * @param int|null $code
     */
    public function __construct(Throwable $previous = null, $message = "", $code = 0)
    {
        parent::__construct($message, $code, $previous);
    }
}