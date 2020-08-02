<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class CouponAlreadyUsedException extends Exception implements FlashException, HttpExceptionInterface
{
    public function __construct()
    {
        parent::__construct('Coupon already used');
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
