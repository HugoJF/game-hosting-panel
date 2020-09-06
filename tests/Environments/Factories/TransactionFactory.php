<?php

namespace Tests\Environments\Factories;

use App\Transaction;
use App\User;

class TransactionFactory extends Factory
{
    protected Transaction $transaction;

    public function model(): Transaction
    {
        return $this->transaction;
    }

    public function setValue($value): TransactionFactory
    {
        $this->parameters['value'] = $value;

        return $this;
    }

    public function setUser(User $user): TransactionFactory
    {
        $this->parameters['user_id'] = $user->id;

        return $this;
    }

    public function build()
    {
        return ($this->transaction = factory(Transaction::class)->create($this->parameters));
    }
}
