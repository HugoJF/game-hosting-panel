<?php

namespace App\Listeners;

use App\Services\PterodactylApiService;
use App\User;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;

class RegisterUserOnPanel implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var Pterodactyl
     */
    protected $pterodactyl;

    /**
     * Create the event listener.
     *
     * @param Pterodactyl $pterodactyl
     */
    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     *
     * @return void
     * @throws Exception
     */
    public function handle(Registered $event): void
    {
        /** @var User $user */
        $user = $event->user;

        $panelUser = $this->pterodactyl->createUser([
            'username' => $user->username,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ]);

        // Check if API returned a user. If it did not, that was probably because of an error.
        if (!($panelUser instanceof \HCGCloud\Pterodactyl\Resources\User)) {
            /** @var PterodactylApiService $api */
            $api = app(PterodactylApiService::class);

            /** @var Collection $users */
            $users = collect($api->users());

            $sameEmail = $users->where('email', $user->email);

            if ($sameEmail->count() === 0) {
                throw new Exception("Could not find user with email $user->email");
            }

            $panelUser = $sameEmail->first();
        }

        $user->panel_id = $panelUser->id;
        $user->save();
    }
}
