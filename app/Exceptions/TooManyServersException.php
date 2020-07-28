<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class TooManyServersException extends Exception implements FlashException, HttpExceptionInterface
{
    public function __construct()
    {
        parent::__construct('You have too many servers!');
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return 403;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return [];
    }
}
