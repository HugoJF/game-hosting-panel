<?php

namespace Tests\Environments\Factories;

use App\User;

class UserFactory extends Factory
{
    protected User $user;

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

    public function addTransaction($balance)
    {
        return $this->transaction->setValue($balance);
    }

    public function noServerLimit()
    {
        return $this->setServerLimit(0);
    }

    public function model(): User
    {
        return $this->user;
    }

    public function build()
    {
        $this->user = factory(User::class)->create($this->parameters);

        $this->transaction->setUser($this->user);
        $this->transaction->build();

        return $this->user;
    }
}
