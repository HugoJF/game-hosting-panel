<?php

namespace Tests\Unit\Helpers;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function test_save_helper_works(): void
    {
        $user = factory(User::class)->create();

        $update = ['username' => 'nice'];

        $user->forceFill($update);

        $this->assertEquals($user, save($user));

        $this->assertDatabaseHas('users', $update);
    }
}
