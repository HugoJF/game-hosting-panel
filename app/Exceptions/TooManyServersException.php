<?php

namespace App\Exceptions;

use Exception;

class TooManyServersException extends Exception implements FlashException
{
    public function __construct()
    {
        parent::__construct('You have too many servers!');
    }
}
