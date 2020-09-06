<?php

namespace Tests\Environments\Factories;

use App\User;

class UserFactory extends Factory
{
    protected string $for = User::class;

    public TransactionFactory $transaction;

    public function __construct()
    {
        $this->transaction = new TransactionFactory;
    }

    public function setServerLimit($limit): UserFactory
    {
        $this->parameters['server_limit'] = $limit;

        return $this;
    }

    public function noServerLimit()
    {
        return $this->setServerLimit(0);
    }

    public function setBalance($balance)
    {
        return $this->transaction->setValue($balance);
    }

    public function postBuild(): void
    {
        $this->transaction->setUser($this->model);
        $this->transaction->build();
    }
}
