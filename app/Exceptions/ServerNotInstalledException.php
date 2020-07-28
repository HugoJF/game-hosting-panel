<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ServerNotInstalledException extends Exception implements FlashException, HttpExceptionInterface
{
    public function __construct()
    {
        parent::__construct('This server is not installed yet!');
    }

    /**
     * @inheritDoc
     */
    public function getStatusCode()
    {
        return 503;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return [];
    }
}
