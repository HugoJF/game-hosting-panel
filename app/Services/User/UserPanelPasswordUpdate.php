<?php

namespace App\Services\User;

use App\Services\PterodactylApiService;
use App\User;
use HCGCloud\Pterodactyl\Resources\User as UserResource;

class UserPanelPasswordUpdate
{
    protected PterodactylApiService $api;

    public function __construct(PterodactylApiService $api)
    {
        $this->api = $api;
    }

    public function handle(User $user, string $newPassword): bool
    {
        $resource = $this->find($user->email);

        if (!$resource) {
            return false;
        }

        $resource->update([
            'password' => $newPassword,
        ]);

        return true;
    }

    protected function find(string $email): ?UserResource
    {
        return collect($this->api->users())
            ->filter(fn(UserResource $resource) => $resource->email === $email)
            ->first();
    }
}
