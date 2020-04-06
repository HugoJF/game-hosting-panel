<?php

namespace App\Traits;

use App\Transaction;

trait HasTransactions
{
    public function getBalanceAttribute()
    {
        return $this->transactions()->sum('value');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function hasBalance($amount): bool
    {
        return $this->balance >= $amount;
    }
}
