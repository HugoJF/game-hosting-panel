<?php

namespace Tests\Unit\Service\User;

use App\Node;
use App\Services\PterodactylApiService;
use App\Services\User\AllocationSelectionService;
use HCGCloud\Pterodactyl\Resources\Allocation;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AllocationSelectionServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function todo_test_api_is_paginated()
    {
        //
    }

    /**
     * TODO: split the service into 2 functions: one to filter allocations and another to select the best one.
     */
    public function test_assigned_allocations_are_filtered()
    {
        /** @var Node $node */
        $node = factory(Node::class)->make([
            'id' => 1,
        ]);

        $this->mock(PterodactylApiService::class)
             ->shouldReceive('allocations')
             ->withArgs([$node->id])
             ->andReturn([
                 new Allocation(['assigned' => true]),
                 new Allocation(['assigned' => false]),
             ])
             ->once();

        $service = app(AllocationSelectionService::class);

        $allocation = $service->handle($node);

        $this->assertFalse($allocation->assigned);
    }
}
