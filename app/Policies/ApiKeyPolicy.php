<?php

namespace App\Policies;

use App\ApiKey;
use App\User;

class ApiKeyPolicy extends BasePolicy
{
	public function index(User $user)
	{
		return true;
	}

	public function create(User $user)
	{
		return true;
	}

	public function update(User $user, ApiKey $key)
	{
		return $key->user->is($user);
	}

	public function delete(User $user, ApiKey $key)
	{
		return $key->user->is($user);
	}
}
