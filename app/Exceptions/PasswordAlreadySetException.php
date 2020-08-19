<?php

namespace App\Exceptions;

use Exception;

class PasswordAlreadySetException extends Exception implements FlashException
{
    public function __construct()
    {
        parent::__construct('User already set a password!');
    }
}
