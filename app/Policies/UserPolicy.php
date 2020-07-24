<?php

namespace App\Policies;

use App\User;

class UserPolicy extends BasePolicy
{
    public function update(User $user, User $other): bool
    {
        return false;
    }
}
