<?php

namespace Tests\Environments;

use App\Transaction;
use App\User;
use Tests\Environments\Factories\TransactionFactory;
use Tests\Environments\Factories\UserFactory;

class UserEnvironment extends BaseEnvironment
{
    public function __construct()
    {
        parent::__construct();

        $this->registerFactory(TransactionFactory::class);
        $this->registerFactory(UserFactory::class);
    }

    public function resolveDependencies(): void
    {
        parent::resolveDependencies();

        $this->userFactory()->create();
        $this->transactionFactory()->create();
    }

    public function transactionFactory(): TransactionFactory
    {
        return $this->dependency(TransactionFactory::class);
    }

    public function transaction(): Transaction
    {
        return $this->transactionFactory()->model();
    }

    public function userFactory(): UserFactory
    {
        return $this->dependency(UserFactory::class);
    }

    public function user(): User
    {
        return $this->userFactory()->model();
    }
}
