<?php

namespace App\Http\Controllers\User;

use App\Game;
use App\Http\Controllers\Controller;
use App\Jobs\AsyncServerDeployment;
use App\Location;
use App\Services\User\NodeSelectionService;
use App\Services\User\ServerCreationService;
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
        Request $request,
        Game $game,
        Location $location
    ) {
        // Selects node to create the server on
        $node = $nodeSelection->handle($location);

        // Create the server
        $server = $serverCreation->handle(auth()->user(), $game, $node, $request->input());

        // Dispatch async deployment
        dispatch(new AsyncServerDeployment($server, 'hourly', $request->input()));

        return redirect()->route('home');
    }
}
