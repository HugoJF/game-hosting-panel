<?php

namespace App\Observers;

use App\Exceptions\InsufficientBalanceException;
use App\Transaction;

class TransactionObserver
{
    public function creating(Transaction $transaction)
    {
        if (!$transaction->user->hasBalance(abs($transaction->value))) {
            throw new InsufficientBalanceException;
        }
    }

    public function updating(Transaction $transaction)
    {
        $old = $transaction->getOriginal('value');
        $new = $transaction->value;

        $diff = $new - $old;

        if ($diff < 0 && !$transaction->user->hasBalance(abs($diff))) {
            throw new InsufficientBalanceException;
        }
    }
}
