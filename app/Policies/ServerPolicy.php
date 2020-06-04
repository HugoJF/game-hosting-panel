<?php

namespace App\Policies;

use App\Server;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServerPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function list(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function view(User $user, Server $server)
    {
        return $user->id === $server->user_id;
    }

    public function search(User $user, Server $server)
    {
        return $user->id === $server->user_id;
    }

    public function deploy(User $user, Server $server)
    {
        return $user->id === $server->user_id;
    }

    public function terminate(User $user, Server $server)
    {
        return $user->id === $server->user_id;
    }

    public function forceTerminate(User $user, Server $server)
    {
        return $user->id === $server->user_id;
    }

    public function destroy(User $user, Server $server)
    {
        return $user->id === $server->user_id;
    }
}
