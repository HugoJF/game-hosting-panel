<?php

namespace Tests\Unit\Service\Environment;

use App\Game;
use App\Location;
use App\Node;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Environments\UserEnvironment;
use Tests\TestCase;

class UserEnvironmentTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function test_user_environment()
    {
        ($env = new UserEnvironment)
            ->userFactory()
            ->withBalance(0);

        $env->resolveDependencies();

        $this->assertInstanceOf(Game::class, $env->game());
        $this->assertInstanceOf(Location::class, $env->location());
        $this->assertInstanceOf(Node::class, $env->node());
        $this->assertInstanceOf(User::class, $env->user());
    }
}
