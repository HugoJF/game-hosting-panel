<?php

namespace App\Services\User;

use App\Node;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;

class AllocationSelectionService
{
    /**
     * @var Pterodactyl
     */
    protected $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    public function handle(Node $node): Allocation
    {
        $allocations = $this->pterodactyl->allocations($node->id);

        return collect($allocations['data'])->random();
    }
}
