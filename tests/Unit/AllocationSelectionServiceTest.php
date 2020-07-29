<?php

namespace Tests\Unit;

use App\Node;
use App\Services\User\AllocationSelectionService;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;
use Mockery;
use Tests\TestCase;

class AllocationSelectionServiceTest extends TestCase
{
    /**
     * TODO: split the service into 2 functions: one to filter allocations and another to select the best one.
     */
    public function test_assigned_allocations_are_filtered()
    {
        /** @var Node $node */
        $node = factory(Node::class)->make([
            'id' => 1,
        ]);

        $this->mockPterodactyl()
            ->

        $this->mock(Pterodactyl::class)
             ->shouldReceive('allocations')
             ->withArgs([$node->id])
             ->andReturn([
                 'data' => [
                     new Allocation(['assigned' => true]),
                     new Allocation(['assigned' => false]),
                 ],
             ])
             ->once();

        $service = app(AllocationSelectionService::class);

        $allocation = $service->handle($node);

        $this->assertFalse($allocation->assigned);
    }
}
