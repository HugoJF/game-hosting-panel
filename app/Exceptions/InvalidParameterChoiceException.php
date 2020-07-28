<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class InvalidParameterChoiceException extends Exception implements HttpExceptionInterface
{
    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return 400;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return [];
    }
}
