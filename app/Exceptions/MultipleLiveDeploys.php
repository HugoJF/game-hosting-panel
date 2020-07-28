<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class MultipleLiveDeploys extends Exception implements HttpExceptionInterface
{
    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return 500;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return [];
    }
}
