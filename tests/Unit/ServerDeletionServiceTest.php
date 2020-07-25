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

        $mocked = Mockery::mock(DeployCreationService::class);
        $this->instance(DeployCreationService::class, $mocked);
        $mocked->shouldReceive('preChecks')->once();
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

        $this->instance(Pterodactyl::class, Mockery::mock(Pterodactyl::class, function ($mock) use ($server) {
            /** @var Mockery\Mock $mock */
            $mock
                ->shouldReceive('deleteServer')
                ->withArgs([$server->panel_id])
                ->once();
        }));

        /** @var ServerDeletionService $service */
        $service = app(ServerDeletionService::class);

        $service->handle($server);

        $this->assertEquals(now(), $server->deleted_at);
    }
}
