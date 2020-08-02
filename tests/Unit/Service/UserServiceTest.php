<?php

namespace Tests\Unit\Service;

use App\Services\ApiKeyService;
use App\Services\UserService;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected UserService $service;
    protected array $create;
    protected array $update;
    protected array $extra;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(UserService::class);
        $this->create = [
            'first_name' => 'first name',
            'last_name'  => 'last name',
            'username'   => 'username',
            'locale'     => 'en',
            'password'   => bcrypt('pog'),
        ];
        $this->update = [
            'first_name' => 'second first name',
            'last_name'  => 'second last name',
            'username'   => 'second username',
            'locale'     => 'pt-br',
            'password'   => bcrypt('kek'),
        ];
        $this->extra = [
            'server_limit'           => 100,
            'server_expiration_days' => 200,
        ];
    }

    public function test_update_will_fill_and_persist(): void
    {
        $user = factory(User::class)->create($this->create);

        $this->service->update($user, array_merge($this->update, $this->extra));

        $this->assertDatabaseHas('users', $this->update);

        $this->assertNotEquals($this->extra['server_limit'], User::first()->server_limit);
    }

    public function test_update_will_force_fill(): void
    {
        $user = factory(User::class)->create($this->create);

        $this->service->update($user, $this->update, $this->extra);

        $this->assertDatabaseHas('users', array_merge($this->update, $this->extra));
    }
}
