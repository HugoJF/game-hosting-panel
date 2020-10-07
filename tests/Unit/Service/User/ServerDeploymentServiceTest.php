<?php

namespace Tests\Unit\Service\User;

use App\Exceptions\ServerNotInstalledException;
use App\Game;
use App\Node;
use App\Notifications\ServerDeployed;
use App\Server;
use App\Services\ServerService;
use App\Services\User\DeployCreationService;
use App\Services\User\ServerDeployConfigService;
use App\Services\User\ServerDeploymentService;
use App\User;
use Carbon\Carbon;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Server as ServerResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Environments\ServerEnvironment;
use Tests\TestCase;

class ServerDeploymentServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected ServerDeploymentService $deploymentService;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2020, 1, 1, 0, 0, 0));
    }

    public function test_exception_will_be_raised_if_trying_to_deploy_a_server_that_is_not_installed(
    ): void
    {
        $server = factory(Server::class)->make();

        $this->mock(ServerService::class)
             ->shouldReceive('isInstalled')
             ->andReturn(false)
             ->once();

        $this->expectException(ServerNotInstalledException::class);

        app(ServerDeploymentService::class)->handle($server, 'daily', [], []);
    }

    public function test_deployment_will_update_server_build_config_with_return_from_service(): void
    {
        ($environment = new ServerEnvironment)
            ->serverFactory()
            ->setParameter('panel_id', 42);

        $environment->resolveDependencies();

        $config = [
            'cpu'       => 2400,
            'memory'    => 1024,
            'disk'      => 1000,
            'databases' => 2,
        ];
        $serverConfig = [
            'limits'         => [
                'cpu'       => 2400,
                'memory'    => 1024,
                'disk'      => 1000,
                'databases' => 2,
            ],
            'feature_limits' => [
                'databases' => 3,
            ],
            'allocation'     => 2,
            'oom_disabled'   => true,
        ];
        $billingPeriod = 'daily';

        // Force server to be installed
        $this->mock(ServerService::class)
             ->shouldReceive('isInstalled')
             ->andReturn(true)
             ->once();

        // Mock server build config generation
        $this->mock(ServerDeployConfigService::class)
             ->shouldReceive('handle')
             ->withArgs([$environment->server(), $config])
             ->andReturn($serverConfig)
             ->once();

        // Mock call to update server build
        $this->mock(Pterodactyl::class)
             ->shouldReceive('updateServerBuild')
             ->withArgs([$environment->server()->panel_id, $serverConfig])
             ->andReturn(new ServerResource([
                 'allocation' => [], // this is needed since the property is not defined in the Resource
             ]))
             ->once();

        // Mock call to register deploy to database
        $this->mock(DeployCreationService::class)
             ->shouldReceive('handle')
             ->withArgs([$environment->server(), $billingPeriod, $config, []])
             ->once();

        $this->expectsNotification($environment->user(), ServerDeployed::class);

        app(ServerDeploymentService::class)->handle($environment->server(), $billingPeriod, $config, []);
    }
}
