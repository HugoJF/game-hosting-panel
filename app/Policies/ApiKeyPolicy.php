<?php

namespace App\Policies;

use App\ApiKey;
use App\User;

class ApiKeyPolicy extends BasePolicy
{
	public function index(User $user): bool
    {
		return true;
	}

	public function create(User $user): bool
    {
		return true;
	}

	public function update(User $user, ApiKey $key): bool
    {
		return $key->user->is($user);
	}

	public function delete(User $user, ApiKey $key): bool
    {
		return $key->user->is($user);
	}
}
