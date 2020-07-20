<?php

namespace App\Services\User;

use App\Node;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;

class AllocationSelectionService
{
    protected Pterodactyl $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    /**
     * Selects a random unassigned allocation from Node
     *
     * @param Node $node
     *
     * @return Allocation
     */
    public function handle(Node $node): Allocation
    {
        $allocations = $this->pterodactyl->allocations($node->id);

        return collect($allocations['data'])
            // Remove assigned allocations
            ->reject(fn(Allocation $allocation) => $allocation->assigned)
            ->random();
    }
}
