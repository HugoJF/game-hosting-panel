<?php

namespace App\Http\Controllers\User;

use App\Game;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvancedDeployRequest;
use App\Location;
use App\Server;
use App\Services\User\AutoServerDeploymentService;
use App\Services\User\DeployTerminationService;
use App\Services\User\NodeSelectionService;
use App\Services\User\ServerCreationService;
use App\Services\User\ServerDeletionService;
use App\Services\User\ServerDeploymentService;
use App\Transaction;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $servers = $user->servers;

        return view('servers.index', compact('user', 'servers'));
    }

    public function show(Server $server)
    {
        // TODO: fix this shit show
        $latestDeploys = $server->deploys()->latest()->limit(5)->get();
        $transactions = Transaction::whereIn('id', $latestDeploys->pluck('transaction_id'))->get();

        $deploys = collect($latestDeploys->count() == 0 ? [] : [$latestDeploys->first()]);

        return view('servers.show', compact('server', 'deploys', 'transactions'));
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
        $period = $request->input('period');

        // Selects node to create the server on
        $node = $nodeSelection->handle($location);

        // Checks if user can deploy a server, before creating the server.
        $autoDeployment->preChecks(auth()->user(), $node, $period, $config);

        // Create the server
        $server = $serverCreation->handle(auth()->user(), $game, $node, $config);

        flash()->success("Server created successfully! It will be automatically deployed once installed.");

        return redirect()->route('home');
    }

    public function configureDeploy(Request $request, Server $server)
    {
        return view('servers.custom-deploy', compact('server'));
    }

    public function deploy(ServerDeploymentService $deployment, Server $server)
    {
        // deploy server
        $deployment->handle($server, 'daily', [
            'cpu'       => $server->cpu,
            'memory'    => $server->memory,
            'disk'      => $server->disk,
            'databases' => $server->databases,
        ]);

        flash()->success('Server deployed');

        return redirect()->route('servers.show', $server);
    }

    public function customDeploy(
        ServerDeploymentService $deployment,
        AdvancedDeployRequest $request,
        Server $server
    )
    {
        // deploy server
        $deployment->handle(
            $server,
            $request->get('period'),
            $request->only(['cpu', 'memory', 'disk', 'databases'])
        );

        flash()->success('Server deployed');

        return redirect()->route('servers.show', $server);
    }

    public function terminate(DeployTerminationService $terminationService, Server $server)
    {
        $terminationService->handle($server, false);

        flash()->success('Server set to terminate');

        return back();
    }

    public function forceTerminate(DeployTerminationService $terminationService, Server $server)
    {
        $terminationService->handle($server, true);

        flash()->success('Server terminated');

        return back();
    }

    public function destroy(ServerDeletionService $deletionService, Server $server)
    {
        $deletionService->handle($server);

        flash()->success("Server $server->id was deleted!");

        return back();
    }
}
