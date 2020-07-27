<?php

namespace Tests\Unit;

use App\Services\PterodactylApiService;
use App\Services\User\UserPanelRegistrationService;
use App\User;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\User as UserResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UserPanelRegistrationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected array $userInfo;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userInfo = $userInfo = [
            'username'   => 'cool_username42',
            'email'      => 'contact@cool.com',
            'first_name' => 'Cool',
            'last_name'  => 'Boy',
        ];

        $this->user = factory(User::class)->make($this->userInfo);
    }

    public function test_create_new_user_will_be_called_on_pterodactyl_api(): void
    {
        ($api = Mockery::mock(PterodactylApiService::class))
            ->shouldReceive('users')
            ->andReturn([])
            ->once();
        $this->instance(PterodactylApiService::class, $api);

        ($mocked = Mockery::mock(Pterodactyl::class))
            ->shouldReceive('createUser')
            ->withArgs([$this->userInfo])
            ->andReturn(new UserResource([]))
            ->once();
        $this->instance(Pterodactyl::class, $mocked);

        app(UserPanelRegistrationService::class)->handle($this->user);
    }

    public function test_create_existing_user_will_correctly_search_users_on_api(): void
    {
        ($api = Mockery::mock(PterodactylApiService::class))
            ->shouldReceive('users')
            ->andReturn([
                new UserResource($this->userInfo)
            ])
            ->once();
        $this->instance(PterodactylApiService::class, $api);

        ($mocked = Mockery::mock(Pterodactyl::class))
            ->shouldReceive('createUser')
            ->never();
        $this->instance(Pterodactyl::class, $mocked);

        app(UserPanelRegistrationService::class)->handle($this->user);
    }

    public function test_2_users_cannot_have_the_same_panel_id(): void
    {
        try {
            factory(User::class)->create($this->userInfo);
            factory(User::class)->create($this->userInfo);
        } catch (Exception $e) {
            // SQLSTATE[23000]: Integrity constraint violation: 19 UNIQUE constraint failed: users.email
            $this->assertEquals(23000, $e->getCode());
        }
    }
}
