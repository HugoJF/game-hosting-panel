<?php

namespace App\Exceptions;

use Exception;

class InsufficientBalanceException extends Exception implements FlashException
{
    public function __construct()
    {
        parent::__construct("Insufficient balance!");
    }
}
