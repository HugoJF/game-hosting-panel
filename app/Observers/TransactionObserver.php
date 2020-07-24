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
        if (!$transaction->user->hasBalance($transaction->value)) {
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

        try {
            /** @var User $user */
            $user = $transaction->user;

            $user->notify(new TransactionUpdated($transaction, $old, $new));
        } catch (Exception $e) {
            logger()->error('Failed to notify user of updated transaction');
            report($e);
        }
    }
}
