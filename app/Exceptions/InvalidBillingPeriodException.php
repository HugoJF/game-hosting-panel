<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class InvalidBillingPeriodException extends Exception implements HttpExceptionInterface
{
    public function __construct($billingPeriod)
    {
        parent::__construct("$billingPeriod is not a valid billing period");
    }

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
