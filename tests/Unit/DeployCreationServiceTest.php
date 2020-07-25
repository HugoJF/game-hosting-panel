<?php

namespace Tests\Unit;

use App\Deploy;
use App\Game;
use App\Jobs\ServerCreationMonitor;
use App\Node;
use App\Server;
use App\Services\User\AllocationSelectionService;
use App\Services\User\DeployCostService;
use App\Services\User\DeployCreationService;
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
use Mockery;
use Tests\TestCase;
use Webpatser\Uuid\Uuid;

class DeployCreationServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected $costPerPeriod = 200;

    protected function expectsCostCalculation(): void
    {
        $mocked = Mockery::mock(DeployCostService::class)->makePartial();
        // 'twice' since deploy has a creating() event listener that also uses getCostPerPeriod
        $mocked->shouldReceive('getCostPerPeriod')->andReturn($this->costPerPeriod)->twice();
        $this->instance(DeployCostService::class, $mocked);
    }

    public function test_deploy_model_is_created()
    {
        $this->expectsCostCalculation();

        $game = factory(Game::class)->create();
        $node = factory(Node::class)->create();
        $user = factory(User::class)->create([
            'server_limit' => 1,
        ]);
        $transaction = factory(Transaction::class)->create([
            'value'   => 200,
            'user_id' => $user->id,
        ]);

        $server = factory(Server::class)->create([
            'id'       => 1,
            'panel_id' => 2,
            'game_id'  => $game->id,
            'node_id'  => $node->id,
            'user_id'  => $user->id,
        ]);

        $deploy = app(DeployCreationService::class)->handle($server, 'daily', [
            'cpu'       => 1200,
            'memory'    => 512,
            'disk'      => 2500,
            'databases' => 1,
        ]);

        $this->assertInstanceOf(Deploy::class, $deploy);
        $this->assertEquals($this->costPerPeriod, $deploy->cost_per_period);
    }
}
