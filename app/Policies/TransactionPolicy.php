<?php

namespace App\Policies;

use App\Transaction;
use App\User;

class TransactionPolicy extends BasePolicy
{
	public function list(User $user)
	{
		return true;
	}

    public function search(User $user, Transaction $transaction)
    {
        return $user->id === $transaction->user_id;
	}
}
