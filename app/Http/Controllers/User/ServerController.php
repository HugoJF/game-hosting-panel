<?php

namespace App\Http\Controllers\User;

use App\Game;
use App\Http\Controllers\Controller;
use App\Jobs\AsyncServerDeployment;
use App\Location;
use App\Server;
use App\Services\User\AutoServerDeploymentService;
use App\Services\User\NodeSelectionService;
use App\Services\User\ServerCreationService;
use App\Services\User\ServerDeletionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $servers = $user->servers;

        return view('servers.index', compact('user', 'servers'));
    }

    public function selectGame()
    {
        $games = Game::all();

        return view('servers.select-game', compact('games'));
    }

    public function selectLocation(Game $game)
    {
        $game->loadMissing(['nodes', 'nodes.location']);

        $locations = $game->nodes->pluck('location')->unique('id');

        return view('servers.select-location', compact('game', 'locations'));
    }

    public function configure(Game $game, Location $location)
    {
        return view('servers.configure', compact('game', 'location'));
    }

    public function store(
        NodeSelectionService $nodeSelection,
        ServerCreationService $serverCreation,
        AutoServerDeploymentService $autoDeployment,
        Request $request,
        Game $game,
        Location $location
    )
    {
        // TODO: Extract form parameters
        $config = $request->input();

        // Selects node to create the server on
        $node = $nodeSelection->handle($location);

        // Check if user can create the server
        $autoDeployment->preChecks(auth()->user(), $node, 'minutely', $config);

        // Create the server
        $server = $serverCreation->handle(auth()->user(), $game, $node, $config);

        // Dispatch async deployment
        $autoDeployment->handle($server, 'minutely', $config);

        flash()->success("Server created successfully! It will be automatically deployed once installed.");

        return redirect()->route('home');
    }

    public function destroy(ServerDeletionService $deletionService, Server $server)
    {
        $deletionService->handle($server);

        flash()->success("Server $server->id was deleted!");

        return back();
    }
}
