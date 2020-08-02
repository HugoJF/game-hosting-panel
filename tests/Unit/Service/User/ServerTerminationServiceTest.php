<?php

namespace Tests\Unit\Service\User;

use App\Classes\PterodactylClient;
use App\Deploy;
use App\Server;
use App\Services\User\ServerTerminationService;
use Carbon\Carbon;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Server as ServerResource;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ServerTerminationServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_server_termination(): void
    {
        /** @var Server $server */
        $server = factory(Server::class)->make(['panel_id' => 42]);

        /** @var Deploy $deploy */
        $deploy = factory(Deploy::class)->make([
            'id'              => 1,
            'billing_period'  => 'hourly',
            'cost_per_period' => 100,
            'cpu'             => 2400,
            'memory'          => 1000,
            'disk'            => 10000,
            'databases'       => 0,
            'io'              => 500,
        ]);

        // Set relation without saving to database
        $server->setRelation('deploys', collect([$deploy]));

        // Disable observers to avoid other stuff from running
        Deploy::unsetEventDispatcher();

        $mock = Mockery::mock(Pterodactyl::class);
        $mock
            ->shouldReceive('server')
            ->withArgs([$server->panel_id])
            ->andReturn(new ServerResource([
                'allocation' => [], // this is needed since the property is not defined in the Resource
            ]))
            ->once();
        $mock
            ->shouldReceive('updateServerBuild')
            ->andReturn(new ServerResource([
                'identifier' => 'my_identifier',
            ]))
            ->once();
        $this->instance(Pterodactyl::class, $mock);

        $mock = Mockery::mock(PterodactylClient::class);
        $mockedServer = Mockery::mock(ServerResource::class);
        $mockedServer->shouldReceive('power')
                     ->once();

        $mock
            ->shouldReceive('getServer')
            ->andReturn($mockedServer)
            ->once();
        $this->instance(PterodactylClient::class, $mock);

        $service = app(ServerTerminationService::class);

        $this->assertEquals(null, $deploy->terminated_at);

        $service->handle($server);

        $this->assertEquals(now(), $deploy->terminated_at);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2020, 1, 1, 0, 0, 0));
    }
}
