<?php

namespace App\Exceptions;

use Exception;

class ServerNotInstalledException extends Exception implements FlashException
{
    public function __construct()
    {
        parent::__construct('This server is not installed yet!');
    }
}
