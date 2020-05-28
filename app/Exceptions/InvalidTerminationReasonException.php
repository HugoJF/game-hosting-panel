<?php

namespace App\Exceptions;

use Exception;

class InvalidTerminationReasonException extends Exception
{
    public function __construct($reason)
    {
        parent::__construct("`$reason` is not valid termination reason");
    }
}
