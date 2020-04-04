<?php

namespace App\Services\User;

use App\Location;
use App\Node;

class NodeSelectionService
{
    public function handle(Location $location): Node
    {
        return $location->nodes()->inRandomOrder()->first();
    }
}
