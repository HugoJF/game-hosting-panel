<?php

namespace App\Exceptions;

use Exception;

class InvalidBillingPeriodException extends Exception
{
    public function __construct($billingPeriod)
    {
        parent::__construct("$billingPeriod is not a valid billing period");
    }
}
