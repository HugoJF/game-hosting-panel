<?php

namespace App\Http\Controllers\User;

use App\Game;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Location;
use App\Server;
use App\Services\User\AutoServerDeploymentService;
use App\Services\User\DeployCreationService;
use App\Services\User\DeployTerminationService;
use App\Services\User\NodeSelectionService;
use App\Services\User\ServerCreationService;
use App\Services\User\ServerDeletionService;
use App\Services\User\ServerDeploymentService;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $servers = $user->servers()->with(['game', 'node', 'deploys'])->get();

        return view('servers.index', compact('user', 'servers'));
    }

    public function create()
    {
        return view('servers.create');
    }

    public function store(
        NodeSelectionService $nodeSelection,
        ServerCreationService $serverCreation,
        DeployCreationService $deployCreation,
        Request $request
    )
    {
        $config = $request->input();
        $period = $request->input('billing_period');

        $game = Game::findOrFail($request->input('game'));
        $location = Location::findOrFail($request->input('location'));
        // TODO: Extract form parameters

        // Selects node to create the server on
        $node = $nodeSelection->handle($location);

        // Checks if user can deploy a server, before creating the server.
        $deployCreation->preChecks(auth()->user(), $node, $period, $config);

        // Create the server
        $server = $serverCreation->handle(auth()->user(), $game, $node, $config);

        return new ServerResource($server);
    }

    public function show(Server $server)
    {
        // TODO: fix this shit show
        $latestDeploys = $server->deploys()->latest()->limit(5)->get();
        $transactions = Transaction::whereIn('id', $latestDeploys->pluck('transaction_id'))->get();

        $deploys = collect($latestDeploys->count() == 0 ? [] : [$latestDeploys->first()]);

        return view('servers.show', compact('server', 'deploys', 'transactions'));
    }

    public function configure(Server $server)
    {
        return view('servers.configure', compact('server'));
    }

    public function deploy(Request $request, ServerDeploymentService $deployment, Server $server)
    {
        $deployment->handle(
            $server,
            $request->get('billing_period'),
            $request->only(['cpu', 'memory', 'disk', 'databases'])
        );

        return new ServerResource($server);
    }

    public function terminate(DeployTerminationService $terminationService, Server $server)
    {
        $terminationService->handle($server, 'TERMINATED_BY_USER', false);

        flash()->success('Server set to terminate');

        return back();
    }

    public function forceTerminate(DeployTerminationService $terminationService, Server $server)
    {
        $terminationService->handle($server, 'FORCE_TERMINATED_BY_USER', true);

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
