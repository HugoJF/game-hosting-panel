<?php

namespace App\Observers;

use App\Exceptions\InsufficientBalanceException;
use App\Notifications\TransactionUpdated;
use App\Transaction;
use App\User;
use Exception;

class TransactionObserver
{
    public function creating(Transaction $transaction): void
    {
        // The value of the transaction is negative since a positive transaction means receiving money
        // and a negative transaction means losing money. hasBalance() will check if the user
        // has a balance greater then the parameter passed.
        if (!$transaction->user->hasBalance(-$transaction->value)) {
            throw new InsufficientBalanceException;
        }
    }

    public function updating(Transaction $transaction): void
    {
        $old = $transaction->getOriginal('value');
        $new = $transaction->value;

        $diff = $new - $old;

        if ($diff < 0 && !$transaction->user->hasBalance(abs($diff))) {
            throw new InsufficientBalanceException;
        }

        // Do not notify user when a transaction was just created.
        if ($transaction->wasRecentlyCreated) {
            return;
        }

        try {
            $transaction->user->notify(new TransactionUpdated($transaction, $old, $new));
        } catch (Exception $e) {
            logger()->error('Failed to notify user of updated transaction');
            report($e);
        }
    }
}
