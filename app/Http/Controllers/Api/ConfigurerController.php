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
        })->keyBy('id');
    }

    public function specs(Game $game, Location $location)
    {
        return [
            'cpu'       => [
                'name'        => 'CPU',
                'icon'        => 'cpu',
                'description' => 'Maximum core usage',
                'options'     => [
                    '25'  => '25%',
                    '50'  => '50%',
                    '75'  => '75%',
                    '100' => '100%',
                ],
            ],
            'memory'    => [
                'name'        => 'Memory',
                'icon'        => 'memory',
                'description' => 'Maximum memory usage',
                'options'     => [
                    '1000' => '1 GB',
                    '2000' => '2 GB',
                    '3000' => '3 GB',
                    '4000' => '4 GB',
                    '5000' => '5 GB',
                ],
            ],
            'disk'      => [
                'name'        => 'Disk',
                'icon'        => 'disk',
                'description' => 'Maximum disk usage',
                'options'     => [
                    '5000'  => '5 GB',
                    '10000' => '10 GB',
                    '20000' => '20 GB',
                    '30000' => '30 GB',
                    '40000' => '40 GB',
                    '50000' => '50 GB',
                ],
            ],
            'databases' => [
                'name'        => 'Databases',
                'icon'        => 'databases',
                'description' => 'Maximum database tables',
                'options'     => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
            ],
        ];
    }
}
