<?php

namespace App\Policies;

use App\Transaction;
use App\User;

class TransactionPolicy extends BasePolicy
{
	public function list(User $user): bool
    {
		return true;
	}

    public function search(User $user, Transaction $transaction): bool
    {
        return $user->id === $transaction->user_id;
	}
}
