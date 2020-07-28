<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class InvalidTerminationReasonException extends Exception implements HttpExceptionInterface
{
    public function __construct($reason)
    {
        parent::__construct("`$reason` is not valid termination reason");
    }

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
