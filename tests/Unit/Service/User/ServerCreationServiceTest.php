<?php

namespace Tests\Unit\Service\User;

use App\Exceptions\TooManyServersException;
use App\Game;
use App\Jobs\ServerCreationMonitor;
use App\Node;
use App\Server;
use App\Services\User\AllocationSelectionService;
use App\Services\User\DeployCostService;
use App\Services\User\ServerCreationConfigService;
use App\Services\User\ServerCreationService;
use App\Transaction;
use App\User;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation as AllocationResource;
use HCGCloud\Pterodactyl\Resources\Server as ServerResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Environments\UserEnvironment;
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

    public function test_server_creation_service_will_create_a_server(): void
    {
        $this->expectsAllocationSelection();
        $this->expectsServerBuildConfigGeneration();
        $this->expectsPanelServerCreation();
        $this->mockCostServiceToPass();

        $this->expectsJobs(ServerCreationMonitor::class);

        ($environment = new UserEnvironment)
            ->userFactory()
            ->withServerLimit(5)
            ->withBalance(5000);

        $environment->resolveDependencies();

        $result = app(ServerCreationService::class)->handle(
            $environment->user(),
            $environment->game(),
            $environment->node(),
            $this->formData,
            []
        );

        $this->assertInstanceOf(Server::class, $result);
        $this->assertEquals($this->panelId, $result->panel_id);
        $this->assertEquals($this->panelHash, $result->panel_hash);
    }

    public function test_server_creation_will_fail_if_api_didnt_return_resource(): void
    {
        $this->expectsAllocationSelection();
        $this->expectsServerBuildConfigGeneration();
        $this->mockCreateServerToFail();
        $this->mockCostServiceToPass();

        $this->expectException(Exception::class);


        ($environment = new UserEnvironment)
            ->userFactory()
            ->withServerLimit(5)
            ->withBalance(5000);

        $environment->resolveDependencies();

        $result = app(ServerCreationService::class)->handle(
            $environment->user(),
            $environment->game(),
            $environment->node(),
            $this->formData,
            []
        );

        $this->assertInstanceOf(Server::class, $result);
        $this->assertEquals($this->panelId, $result->panel_id);
        $this->assertEquals($this->panelHash, $result->panel_hash);
    }

    protected function expectsAllocationSelection(): void
    {
        $this->mock(AllocationSelectionService::class)
             ->shouldReceive('handle')
             ->andReturn(new AllocationResource([
                 'ip'   => '123.123.123.123',
                 'port' => '12345',
             ]))->once();
    }

    protected function expectsServerBuildConfigGeneration(): void
    {
        $this->mock(ServerCreationConfigService::class)
             ->shouldReceive('handle')
             ->andReturn([])
             ->once();
    }

    protected function expectsPanelServerCreation(): void
    {
        $this->mock(Pterodactyl::class)
             ->shouldReceive('createServer')
             ->andReturn(new ServerResource([
                 'id'         => $this->panelId,
                 'identifier' => $this->panelHash,
             ]))->once();
    }

    protected function mockPanelServerCreationToFail(): void
    {
        $this->mock(Pterodactyl::class)
             ->shouldReceive('createServer')
             ->andReturn(null)
             ->once();
    }

    protected function mockCostServiceToPass(): void
    {
        $this->mock(DeployCostService::class)
             ->shouldReceive('getCostPerPeriod')
             ->andReturn(100)
             ->once();
    }

    public function test_server_creation_fails_if_pterodactyl_does_not_return_a_resource(): void
    {
        $this->expectException(Exception::class);

        ($environment = new UserEnvironment)
            ->userFactory()
            ->noServerLimit()
            ->withBalance(500);

        $environment->resolveDependencies();

        app(ServerCreationService::class)->handle(
            $environment->user(),
            $environment->game(),
            $environment->node(),
            $this->formData,
            []
        );
    }

    public function test_server_creation_will_fail_if_user_is_at_limit(): void
    {
        $this->expectException(TooManyServersException::class);

        $this->mockCostServiceToPass();

        ($environment = new UserEnvironment)
            ->userFactory()
            ->noServerLimit()
            ->withBalance(500);

        $environment->resolveDependencies();

        app(ServerCreationService::class)->handle(
            $environment->user(),
            $environment->game(),
            $environment->node(),
            $this->formData,
            []
        );
    }

    protected function mockCreateServerToFail(): void
    {
        $this->mock(Pterodactyl::class)
             ->shouldReceive('createServer')
             ->andReturn(null)
             ->once();
    }

    protected function mockCreateServerToPass(): void
    {
        $this->mock(Pterodactyl::class)
             ->shouldReceive('createServer')
             ->andReturn(new ServerResource([]))
             ->once();
    }
}
