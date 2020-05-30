<?php

namespace Tests\Unit;

use App\Classes\PterodactylClient;
use App\Deploy;
use App\Server;
use App\Services\User\ServerTerminationService;
use Carbon\Carbon;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ServerTerminationServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2020, 1, 1, 0, 0, 0));
    }

    public function test_server_termination()
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

        $this->instance(Pterodactyl::class, Mockery::mock(Pterodactyl::class, function ($mock) use ($server) {
            /** @var Mockery\Mock $mock */
            $mock
                ->shouldReceive('server')
                ->withArgs([$server->panel_id])
                ->andReturn(new \HCGCloud\Pterodactyl\Resources\Server([
                    'allocation' => [], // this is needed since the property is not defined in the Resource
                ]))
                ->once();

            $mock
                ->shouldReceive('updateServerBuild')
                ->andReturn(new \HCGCloud\Pterodactyl\Resources\Server([
                    'identifier' => 'my_identifier',
                ]))
                ->once();
        }));

        $this->instance(PterodactylClient::class, Mockery::mock(PterodactylClient::class, function ($mock) use ($server) {
            $mockedServer = Mockery::mock(\HCGCloud\Pterodactyl\Resources\Server::class, function ($mock) {
                /** @var Mockery\Mock $mock */
                $mock->shouldReceive('power')
                     ->once();
            });

            /** @var Mockery\Mock $mock */
            $mock
                ->shouldReceive('getServer')
                ->andReturn($mockedServer)
                ->once();
        }));

        $service = app(ServerTerminationService::class);

        $this->assertEquals(null, $deploy->terminated_at);

        $service->handle($server);

        $this->assertEquals(now(), $deploy->terminated_at);
    }
}
