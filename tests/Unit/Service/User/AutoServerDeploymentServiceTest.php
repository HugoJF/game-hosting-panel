<?php

namespace Tests\Unit\Service\User;

use App\Game;
use App\Jobs\AsyncServerDeployment;
use App\Node;
use App\Server;
use App\Services\ServerService;
use App\Services\User\AutoServerDeploymentService;
use App\Services\User\DeployCreationService;
use App\Services\User\ServerDeploymentService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Environments\ServerEnvironment;
use Tests\Environments\UserEnvironment;
use Tests\TestCase;

class AutoServerDeploymentServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_server_deployment_will_be_called_directly_if_server_is_installed(): void
    {
        $this->mockServerService(true);
        $this->mockServerDeploymentService();

        $server = $this->createServer();

        app(AutoServerDeploymentService::class)->handle($server, 'daily', [], []);
    }

    protected function mockServerService(bool $isInstalled): void
    {
        $this->partialMock(ServerService::class)
             ->shouldReceive('isInstalled')
             ->andReturn($isInstalled)
             ->once();
    }

    protected function mockServerDeploymentService(): void
    {
        $this->mock(ServerDeploymentService::class)
             ->shouldReceive('handle')
             ->once();
    }

    protected function createServer()
    {
        ($environment = new ServerEnvironment)
            ->userFactory()
            ->noServerLimit()
            ->withBalance(500);

        $environment->resolveDependencies();

        return $environment->server();
    }

    public function test_server_deployment_will_dispatch_async_server_deployment(): void
    {
        $this->expectsJobs(AsyncServerDeployment::class);
        $this->mockServerService(false);

        $server = $this->createServer();

        app(AutoServerDeploymentService::class)->handle($server, 'daily', [], []);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->mock(DeployCreationService::class)
             ->shouldReceive('preChecks')
             ->once();
    }
}
