<?php

namespace App\Http\Controllers\User;

use App\Events\ServerInstalled;
use App\Game;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServerDeployRequest;
use App\Http\Requests\ServerStoreRequest;
use App\Http\Resources\ServerResource;
use App\Location;
use App\Server;
use App\Services\User\DeployCostService;
use App\Services\User\DeployTerminationService;
use App\Services\User\NodeSelectionService;
use App\Services\User\ServerCreationService;
use App\Services\User\ServerDeletionService;
use App\Services\User\ServerDeploymentService;
use App\Transaction;
use App\User;

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
        ServerStoreRequest $request
    ): ServerResource {
        $config = $request->validated();
        $period = $request->input('billing_period');

        $game = Game::findOrFail($request->input('game'));
        $location = Location::findOrFail($request->input('location'));

        // Selects node to create the server on
        $node = $nodeSelection->handle($location);

        // Checks if user can deploy a server, before creating the server.
        $serverCreation->preChecks(auth()->user(), $node, $period, $config);

        // Create the server
        $server = $serverCreation->handle(auth()->user(), $game, $node, $config);

        return new ServerResource($server);
    }

    public function show(DeployCostService $costService, Server $server)
    {
        event(new ServerInstalled($server));
        $last5 = $server->deploys()->latest()->orderBy('created_at', 'DESC')->limit(5)->get();
        $deploys = collect($last5->first() ? [$last5->first()] : []);
        $transactions = Transaction::findMany($last5->pluck('transaction_id'));

        $costPerPeriod = $costService->getCostPerPeriod(
            $server->node,
            $server->billing_period,
            $server->only(['cpu', 'memory', 'disk', 'databases'])
        );

        return view('servers.show', compact('server', 'deploys', 'transactions', 'costPerPeriod'));
    }

    public function configure(Server $server)
    {
        return view('servers.configure', compact('server'));
    }

    public function update(ServerDeployRequest $request, Server $server)
    {
        $server->billing_period = $request->input('billing_period');
        $server->cpu = $request->input('cpu');
        $server->memory = $request->input('memory');
        $server->disk = $request->input('disk');
        $server->databases = $request->input('databases');

        $server->update();

        flash()->success('Server parameters updated successfully!');

        return new ServerResource($server);
    }

    public function deploying(DeployCostService $costService, Server $server)
    {
        $costPerPeriod = $costService->getCostPerPeriod(
            $server->node,
            $server->billing_period,
            $server->only(['cpu', 'memory', 'disk', 'databases'])
        );

        return view('servers.deploying', compact('server', 'costPerPeriod'));
    }

    public function deploy(ServerDeploymentService $deployment, Server $server)
    {
        $deployment->handle(
            $server,
            $server->billing_period,
            $server->only(['cpu', 'memory', 'disk', 'databases'])
        );

        flash()->success('Server successfully deployed!');

        return redirect()->route('servers.show', $server);
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
