<?php

namespace App\Exceptions;

use Throwable;
use Exception;

class UserMessageException extends Exception
{
    public function __construct(string $message, int $code = 500, ?Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
