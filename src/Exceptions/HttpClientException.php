<?php

declare(strict_types=1);

namespace Kbk\NepaliPaymentGateway\Exceptions;

use Exception;
use Throwable;

class HttpClientException extends Exception
{
    public function __construct(string $message='', int $code=0, ?Throwable $throwable=null)
    {
        parent::__construct($message, $code, $throwable);
    }
}