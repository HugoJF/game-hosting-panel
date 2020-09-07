<?php

namespace Tests\Unit\Service\User;

use App\Server;
use App\Services\User\ServerDeployConfigService;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Server as ServerResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServerDeployConfigServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_service_creates_config_with_required_parameters(): void
    {
        $server = factory(Server::class)->make(['panel_id' => 42]);

        $this->mock(Pterodactyl::class)
             ->shouldReceive('server')
             ->andReturn(new ServerResource([
                 'allocation' => [], // this is needed since the property is not defined in the Resource
             ]))
             ->once();

        $config = app(ServerDeployConfigService::class)->handle($server, [
            'cpu'       => 1200,
            'memory'    => 512,
            'disk'      => 5000,
            'databases' => 0,
        ]);

        $this->assertArrayHasKey('limits', $config);
        $this->assertArrayHasKey('feature_limits', $config);
        $this->assertArrayHasKey('allocation', $config);
        $this->assertArrayHasKey('oom_disabled', $config);
    }
}
