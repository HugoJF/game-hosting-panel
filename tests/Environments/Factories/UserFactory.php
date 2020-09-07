<?php

namespace Tests\Environments\Factories;

use App\User;

class UserFactory extends Factory
{
    protected string $for = User::class;

    public TransactionFactory $transaction;

    public function __construct(TransactionFactory $transactionFactory)
    {
        $this->transaction = $transactionFactory;
    }

    public function withServerLimit($limit): UserFactory
    {
        $this->parameters['server_limit'] = $limit;

        return $this;
    }

    public function noServerLimit()
    {
        return $this->withServerLimit(0);
    }

    public function withBalance($balance)
    {
        return $this->transaction->setValue($balance);
    }

    public function postCreate(): void
    {
        $this->transaction->setUser($this->model);
    }
}
