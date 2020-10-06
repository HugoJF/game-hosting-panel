<?php

namespace App\Services\User;

use App\Game;
use App\Node;

class NodeSelectionService
{
    public function handle(Game $game): Node
    {
        return $game->nodes()->inRandomOrder()->first();
    }
}
