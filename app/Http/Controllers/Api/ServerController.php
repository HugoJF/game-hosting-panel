<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;
use App\Location;
use App\Services\User\AutoServerDeploymentService;
use App\Services\User\NodeSelectionService;
use App\Services\User\ServerCreationService;
use Exception;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function store(
        NodeSelectionService $nodeSelection,
        ServerCreationService $serverCreation,
        AutoServerDeploymentService $autoDeployment,
        Request $request
    )
    {
        $config = $request->input();
        $period = $request->input('period');
        $game = Game::findOrFail($request->input('game'));
        $location = Location::findOrFail($request->input('location'));
        // TODO: Extract form parameters

        // Selects node to create the server on
        $node = $nodeSelection->handle($location);

        // Checks if user can deploy a server, before creating the server.
        $autoDeployment->preChecks(auth()->user(), $node, $period, $config);

        // Create the server
        return $serverCreation->handle(auth()->user(), $game, $node, $config);
    }
}
