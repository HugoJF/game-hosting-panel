<?php

namespace Tests\Unit;

use App\Services\User\UserPanelRegistrationService;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UserPanelRegistrationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_will_be_called_on_pterodactyl_api()
    {
        $userInfo = [
            'username'   => 'cool_username42',
            'email'      => 'contact@cool.com',
            'first_name' => 'Cool',
            'last_name'  => 'Boy',
        ];

        $user = factory(User::class)->make($userInfo);

        $this->instance(Pterodactyl::class, Mockery::mock(Pterodactyl::class, function ($mock) use ($userInfo) {
            /** @var Mockery\Mock $mock */
            $mock
                ->shouldReceive('createUser')
                ->withArgs([$userInfo])
                ->once();
        }));

        /** @var UserPanelRegistrationService $service */
        $service = app(UserPanelRegistrationService::class);

        $service->handle($user);
    }
}
