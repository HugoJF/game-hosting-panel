<?php

namespace App\Policies;

use App\Deploy;
use App\User;

class DeployPolicy extends BasePolicy
{
    public function search(User $user, Deploy $deploy)
    {
        return $user->id === $deploy->server->user_id;
	}
}
