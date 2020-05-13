<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;
use App\Location;
use App\Node;

class ConfigurerController extends Controller
{
    public function games()
    {
        return Game::all()->keyBy('id');
    }

    public function locations(Game $game)
    {
        $locations = Location::with(['nodes', 'nodes.games'])->get();

        // Serialize Location and add 'available' field, if ANY node has $game
        return $locations->map(function (Location $location) use ($game) {
            $arr = $location->attributesToArray();
            // Check if we have a Node, that has $game
            $arr['available'] = $location->nodes->filter(function (Node $node) use ($game) {
                    return $node->games->filter(function (Game $g) use ($game) {
                            return $g->id === $game->id;
                        })->count() > 0;
                })->count() > 0;

            return $arr;
        });
    }
}
