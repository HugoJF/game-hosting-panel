<?php

namespace App\Services\User;

use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;

class UserPanelRegistrationService
{
    protected Pterodactyl $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    public function handle(User $user)
    {
        return $this->pterodactyl->createUser([
            'username' => $user->username,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
        ]);
    }
}
