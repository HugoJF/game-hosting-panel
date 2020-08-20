<?php

namespace Tests\Unit;

use App\Services\InviteService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InviteServiceTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    protected InviteService $service;

    protected string $email = 'asd@asd.com';
    protected int $funds = 1000;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(InviteService::class);
    }

    public function test_invite_service_will_create_user_and_add_funds(): void
    {
        $this->expectsEvents(Registered::class);

        $user = $this->service->invite($this->email, $this->funds);

        auth()->login($user);

        $this->assertEquals($this->funds, $user->balance);
        $this->assertNull(auth()->user()->password);
    }
}
