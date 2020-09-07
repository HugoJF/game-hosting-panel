<?php

namespace Tests\Unit\Service\Environment;

use App\Game;
use App\Location;
use App\Node;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Environments\BaseEnvironment;
use Tests\TestCase;

class BaseEnvironmentTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function test_base_environment()
    {
        $env = new BaseEnvironment;

        $env->resolveDependencies();

        $this->assertInstanceOf(Game::class, $env->game());
        $this->assertInstanceOf(Location::class, $env->location());
        $this->assertInstanceOf(Node::class, $env->node());

        $this->assertEquals(1, Game::count());
        $this->assertEquals(1, Location::count());
        $this->assertEquals(1, Node::count());
    }
}
