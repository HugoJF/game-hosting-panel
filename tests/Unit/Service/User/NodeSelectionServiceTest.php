<?php

namespace Tests\Unit\Service\User;

use App\Location;
use App\Node;
use App\Services\User\NodeSelectionService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NodeSelectionServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function test_node_selection_server_returns_node(): void
    {
        $location = factory(Location::class)->create(['id' => 1]);
        factory(Node::class)->create([
            'location_id' => $location->id,
        ]);

        $node = app(NodeSelectionService::class)->handle($location);

        $this->assertInstanceOf(Node::class, $node);
    }
}
