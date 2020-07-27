<?php

namespace App\Listeners;

use App\Services\PterodactylApiService;
use App\Services\User\UserPanelRegistrationService;
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

    protected UserPanelRegistrationService $registrationService;

    /**
     * Create the event listener.
     *
     * @param UserPanelRegistrationService $registrationService
     */
    public function __construct(UserPanelRegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     *
     * @return void
     * @throws Exception
     */
    public function handle($event): void
    {
        /** @var User $user */
        $user = $event->user;

        if ($user->panel_id) {
            return;
        }

        $resource = $this->registrationService->handle($user);

        $user->panel_id = $resource->id;
        $user->save();
    }
}
