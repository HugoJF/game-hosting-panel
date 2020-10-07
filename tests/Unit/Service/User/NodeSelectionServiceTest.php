<?php

namespace Tests\Unit\Service\User;

use App\Location;
use App\Node;
use App\Services\PterodactylApiService;
use App\Services\User\NodeSelectionService;
use HCGCloud\Pterodactyl\Resources\Allocation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Environments\ServerEnvironment;
use Tests\TestCase;

class NodeSelectionServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function test_node_selection_server_returns_node(): void
    {
        $environment = (new ServerEnvironment);

        $environment->resolveDependencies();

        $node = app(NodeSelectionService::class)->handle($environment->location(), $environment->game());

        $this->assertInstanceOf(Node::class, $node);
    }

    public function todo_test_node_selection_will_not_select_uncompatible_node()
    {
        // TODO: nodes that do not have the game attached to it.
    }
}
