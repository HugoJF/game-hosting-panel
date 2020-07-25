<?php

namespace Tests\Unit;

use App\Game;
use App\Jobs\ServerCreationMonitor;
use App\Node;
use App\Server;
use App\Services\User\AllocationSelectionService;
use App\Services\User\ServerCreationConfigService;
use App\Services\User\ServerCreationService;
use App\User;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation as AllocationResource;
use HCGCloud\Pterodactyl\Resources\Server as ServerResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class ServerCreationServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected array $formData = [
        'billing_period' => 'daily',
        'cpu'            => 2400,
        'memory'         => 512,
        'disk'           => 2000,
        'databases'      => 0,
    ];

    protected int $panelId = 512;
    protected string $panelHash = 'random_hash';

    protected function expectsAllocationSelection(): void
    {
        $mocked = Mockery::mock(AllocationSelectionService::class);
        $mocked->shouldReceive('handle')->andReturn(new AllocationResource([
            'ip'   => '123.123.123.123',
            'port' => '12345',
        ]))->once();
        $this->instance(AllocationSelectionService::class, $mocked);
    }

    protected function expectsServerBuildConfigGeneration(): void
    {
        $mocked = Mockery::mock(ServerCreationConfigService::class);
        $mocked->shouldReceive('handle')->andReturn([])->once();
        $this->instance(ServerCreationConfigService::class, $mocked);
    }

    protected function expectsPanelServerCreation(): void
    {
        $mocked = Mockery::mock(Pterodactyl::class);
        $mocked->shouldReceive('createServer')->andReturn(new ServerResource([
            'id'         => $this->panelId,
            'identifier' => $this->panelHash,
        ]))->once();
        $this->instance(Pterodactyl::class, $mocked);
    }

    protected function mockCreateServerToFail(): void
    {
        $mocked = Mockery::mock(Pterodactyl::class);
        $mocked->shouldReceive('createServer')->andReturn(null)->once();
        $this->instance(Pterodactyl::class, $mocked);
    }

    public function test_server_creation_service_will_create_a_server(): void
    {
        $this->expectsAllocationSelection();
        $this->expectsServerBuildConfigGeneration();
        $this->expectsPanelServerCreation();

        $this->expectsJobs(ServerCreationMonitor::class);

        $game = factory(Game::class)->create();
        $node = factory(Node::class)->create();
        $user = factory(User::class)->create();

        $result = app(ServerCreationService::class)->handle($user, $game, $node, $this->formData);

        $this->assertInstanceOf(Server::class, $result);
        $this->assertEquals($this->panelId, $result->panel_id);
        $this->assertEquals($this->panelHash, $result->panel_hash);
    }

    public function test_server_creation_fails_if_pterodactyl_does_not_return_a_resource(): void
    {
        $this->expectException(Exception::class);

        $this->expectsServerBuildConfigGeneration();
        $this->expectsAllocationSelection();
        $this->mockCreateServerToFail();

        $game = factory(Game::class)->create();
        $node = factory(Node::class)->create();
        $user = factory(User::class)->create();

        app(ServerCreationService::class)->handle($user, $game, $node, $this->formData);
    }
}
