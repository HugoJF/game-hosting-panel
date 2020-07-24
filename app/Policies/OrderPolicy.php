<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function list(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }
}
