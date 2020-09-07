<?php

namespace Tests\Environments\Factories;

use App\User;
use function Clue\StreamFilter\register;

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
        $this->transaction->setValue($balance);

        return $this;
    }

    public function postCreate(): void
    {
        $this->transaction->setUser($this->model);
    }
}
