<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function list(User $user): bool
    {
        return true;
    }
}
