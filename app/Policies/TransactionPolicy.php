<?php

namespace App\Policies;

use App\User;

class TransactionPolicy extends BasePolicy
{
	public function list(User $user)
	{
		return true;
	}
}
