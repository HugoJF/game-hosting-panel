<?php

namespace Tests\Unit;

use App\Exceptions\PasswordAlreadySetException;
use App\Services\AccountService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AccountServiceTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    protected AccountService $service;

    protected string $password = 'mysecretpassowrd';
    protected $email = 'asd@asd.com';

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(AccountService::class);
    }

    public function test_password_service_will_set_password_and_authenticate_user(): void
    {

        $user = factory(User::class)->create([
            'email'    => $this->email,
            'password' => null,
        ]);

        $this->service->set($user, $this->password);

        $this->assertAuthenticatedAs($user);
        $this->assertNotNull(auth()->user()->password);
    }

    public function test_service_will_fail_if_user_already_has_a_password()
    {
        $user = factory(User::class)->create();

        $this->expectException(PasswordAlreadySetException::class);

        $this->service->set($user, '123');
    }
}
