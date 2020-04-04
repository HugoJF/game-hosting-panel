<?php

namespace App\Policies;

use App\User;

class TransactionPolicy extends BasePolicy
{
	public function index(User $user)
	{
		return true;
	}
}
