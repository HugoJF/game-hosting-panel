<?php

namespace App\Services\User;

use App\Services\PterodactylApiService;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\User as UserResource;

class UserPanelRegistrationService
{
    protected PterodactylApiService $api;
    protected Pterodactyl $pterodactyl;

    public function __construct(PterodactylApiService $api, Pterodactyl $pterodactyl)
    {
        $this->api = $api;
        $this->pterodactyl = $pterodactyl;
    }

    public function handle(User $user): UserResource
    {
        $resource = $this->find($user->email);

        if (!$resource) {
            $resource = $this->pterodactyl->createUser([
                'username'   => $user->username,
                'email'      => $user->email,
                'first_name' => $user->first_name,
                'last_name'  => $user->last_name,
            ]);
        }

        return $resource;
    }

    protected function find(string $email): ?UserResource
    {
        return collect($this->api->users())
            ->filter(fn(UserResource $resource) => $resource->email === $email)
            ->first();
    }
}
