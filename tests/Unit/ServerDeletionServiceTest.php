<?php

namespace Tests\Unit;

use App\Game;
use App\Node;
use App\Server;
use App\Services\User\DeployCreationService;
use App\Services\User\ServerDeletionService;
use App\User;
use Carbon\Carbon;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ServerDeletionServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2020, 1, 1, 0, 0, 0));
    }

    public function test_server_deletion(): void
    {
        $game = factory(Game::class)->create();
        $node = factory(Node::class)->create();
        $user = factory(User::class)->create();

        $server = factory(Server::class)->create([
            'id'       => 1,
            'panel_id' => 2,
            'game_id' => $game->id,
            'node_id' => $node->id,
            'user_id' => $user->id,
        ]);

        $this->mock(Pterodactyl::class)
            ->shouldReceive('deleteServer')
            ->withArgs([$server->panel_id])
            ->once();

        app(ServerDeletionService::class)->handle($server);

        $this->assertEquals(now(), $server->deleted_at);
    }
}
