<?php

namespace Tests\Unit;

use App\Classes\PterodactylClient;
use App\Deploy;
use App\Exceptions\ServerNotInstalledException;
use App\Server;
use App\Services\ServerService;
use App\Services\User\DeployCreationService;
use App\Services\User\ServerBuildConfigService;
use App\Services\User\ServerDeploymentService;
use App\Services\User\ServerTerminationService;
use Carbon\Carbon;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Server as ServerResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ServerDeploymentServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * @var ServerDeploymentService
     */
    protected $deploymentService;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2020, 1, 1, 0, 0, 0));
    }

    public function test_exception_will_be_raised_if_trying_to_deploy_a_server_that_is_not_installed()
    {
        $server = factory(Server::class)->make();

        $this->instance(ServerService::class, Mockery::mock(ServerService::class, function ($mock) {
            $mock
                ->shouldReceive('isInstalled')
                ->andReturn(false)
                ->once();
        }));

        $this->expectException(ServerNotInstalledException::class);

        app(ServerDeploymentService::class)->handle($server, 'daily', []);
    }

    public function test_deployment_will_update_server_build_config_with_return_from_service()
    {
        /** @var Server $server */
        $server = factory(Server::class)->make(['panel_id' => 42]);

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
        $serverService = Mockery::mock(ServerService::class);
        $this->instance(ServerService::class, $serverService);
        $serverService
            ->shouldReceive('isInstalled')
            ->andReturn(true)
            ->once();

        // Mock server build config generation
        $buildConfigService = Mockery::mock(ServerBuildConfigService::class);
        $buildConfigService
            ->shouldReceive('handle')
            ->withArgs([$server, $config])
            ->andReturn($serverConfig)
            ->once();
        $this->instance(ServerBuildConfigService::class, $buildConfigService);

        // Mock call to update server build
        $pterodactyl = Mockery::mock(Pterodactyl::class);
        $pterodactyl
            ->shouldReceive('updateServerBuild')
            ->withArgs([$server->panel_id, $serverConfig])
            ->andReturn(new ServerResource([
                'allocation' => [], // this is needed since the property is not defined in the Resource
            ]))
            ->once();
        $this->instance(Pterodactyl::class, $pterodactyl);

        // Mock call to register deploy to database
        $deployCreationService = Mockery::mock(DeployCreationService::class);
        $deployCreationService
            ->shouldReceive('handle')
            ->withArgs([$server, $billingPeriod, $config])
            ->once();
        $this->instance(DeployCreationService::class, $deployCreationService);

        app(ServerDeploymentService::class)->handle($server, $billingPeriod, $config);
    }
}
