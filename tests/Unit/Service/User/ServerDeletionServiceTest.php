<?php

namespace Tests\Unit\Service\User;

use App\Game;
use App\Node;
use App\Server;
use App\Services\User\ServerDeletionService;
use App\User;
use Carbon\Carbon;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Environments\ServerEnvironment;
use Tests\TestCase;

class ServerDeletionServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_server_deletion(): void
    {
        ($environment = new ServerEnvironment)
            ->serverFactory()
            ->setParameter('panel_id', 2);

        $environment->resolveDependencies();

        $this->mock(Pterodactyl::class)
             ->shouldReceive('deleteServer')
             ->withArgs([$environment->server()->panel_id])
             ->once();

        app(ServerDeletionService::class)->handle($environment->server());

        $this->assertEquals(now(), $environment->server()->deleted_at);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2020, 1, 1, 0, 0, 0));
    }
}
