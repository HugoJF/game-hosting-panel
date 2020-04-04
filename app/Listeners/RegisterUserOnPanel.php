<?php

namespace App\Listeners;

use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     */
    public function handle(Registered $event)
    {
        /** @var User $user */
        $user = $event->user;

        $panelUser = $this->pterodactyl->createUser([
            'username'   => $user->username,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
        ]);

        $user->panel_id = $panelUser->id;
        $user->save();
    }
}
