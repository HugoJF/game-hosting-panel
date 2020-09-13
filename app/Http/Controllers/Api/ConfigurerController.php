<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;
use App\Location;
use App\Node;
use App\Processors\Processor;
use App\Services\GameService;
use App\Services\User\NodeSelectionService;
use Illuminate\Http\Request;

class ConfigurerController extends Controller
{
    public function periods()
    {
        $periods = config('ghp.billing-periods');

        return collect($periods)
            ->filter(fn($enabled) => $enabled)
            ->map(fn($enabled, $key) => $key)
            ->map(fn($key) => trans("words.$key"));
    }

    public function games()
    {
        return Game::all()->keyBy('id');
    }

    public function locations()
    {
        return Location::all()->map(function (Location $location) {
            return $location->attributesToArray() + [
                    'available' => true,
                ];
        })->keyBy('id');
    }

    public function gameLocations(Game $game)
    {
        $locations = Location::with(['nodes', 'nodes.games'])->get();

        // Serialize Location and add 'available' field, if ANY node has $game
        return $locations->map(function (Location $location) use ($game) {
            $arr = $location->attributesToArray();
            // Check if we have a Node, that has $game
            $arr['available'] = $location->nodes->filter(function (Node $node) use ($game) {
                    return $node->games->filter(fn(Game $g) => $g->id === $game->id)->count() > 0;
                })->count() > 0;

            return $arr;
        })->keyBy('id');
    }

    public function parameters(
        NodeSelectionService $nodeSelection,
        GameService $service,
        Request $request,
        Game $game,
        Location $location
    ): array {
        /** @var Processor $processor */
        $processor = $service->getProcessor($game);

        $processor->setNode($nodeSelection->handle($location));

        return $processor->calculate($request->all());
    }
}
