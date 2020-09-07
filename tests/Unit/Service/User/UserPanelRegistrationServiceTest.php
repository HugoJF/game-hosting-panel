<?php

namespace Tests\Unit\Service\User;

use App\Services\PterodactylApiService;
use App\Services\User\UserPanelRegistrationService;
use App\User;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\User as UserResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPanelRegistrationServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;


    protected array $userInfo;
    protected User $user;

    public function test_create_new_user_will_be_called_on_pterodactyl_api(): void
    {
        $this->mock(PterodactylApiService::class)
             ->shouldReceive('users')
             ->andReturn([])
             ->once();

        $this->mock(Pterodactyl::class)
             ->shouldReceive('createUser')
             ->withArgs([$this->userInfo])
             ->andReturn(new UserResource([]))
             ->once();

        app(UserPanelRegistrationService::class)->handle($this->user);
    }

    public function test_create_existing_user_will_correctly_search_users_on_api(): void
    {
        $this->mock(PterodactylApiService::class)
             ->shouldReceive('users')
             ->andReturn([
                 new UserResource($this->userInfo),
             ])
             ->once();

        $this->mock(Pterodactyl::class)
             ->shouldNotReceive('createUser');

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
}
