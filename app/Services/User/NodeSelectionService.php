<?php

namespace App\Services\User;

use App\Game;
use App\Location;
use App\Node;

class NodeSelectionService
{
    public function handle(Location $location, Game $game): Node
    {
        return $game->nodes()->where('location_id', $location->id)->inRandomOrder()->first();
    }
}
