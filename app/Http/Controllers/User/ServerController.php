<?php

namespace App\Http\Controllers\User;

use App\Game;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServerResource;
use App\Location;
use App\Server;
use App\Services\ConfigurerService;
use App\Services\GameService;
use App\Services\User\DeployCostService;
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
        ConfigurerService $configurerService,
        GameService $gameService,
        Request $request
    ): ServerResource {
        $game = Game::findOrFail($request->input('game'));
        // TODO: we are not using the location for nodeSelection
        $location = Location::findOrFail($request->input('location'));

        $processor = $gameService->getProcessor($game);

        $form = $processor->validateForm($request->all());
        $period = $request->input('billing_period');

        // Selects node to create the server on
        // TODO: this should come from request
        $node = $nodeSelection->handle($game);

        // Transform user form to server cost
        $cost = $configurerService->formToCost($game, $node, $form);

        // Create server configuration
        $config = array_merge($cost, $request->only('name', 'billing_period'));

        // Checks if user can deploy a server, before creating the server.
        $serverCreation->preChecks(auth()->user(), $node, $period, $config);

        // Create the server
        $server = $serverCreation->handle(auth()->user(), $game, $node, $config, $form);

        return new ServerResource($server);
    }

    public function show(DeployCostService $costService, Server $server)
    {
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

    public function update(
        GameService $gameService,
        ConfigurerService $configurerService,
        Request $request,
        Server $server
    ) {
        $processor = $gameService->getProcessor($server->game);
        $form = $processor->validateForm($request->all());

        $cost = $configurerService->formToCost($server->game, $server->node, $form);

        $server->billing_period = $request->input('billing_period');
        $server->cpu = $cost['cpu'];
        $server->memory = $cost['memory'];
        $server->disk = $cost['disk'];
        $server->databases = $cost['databases'];
        $server->form = $form;

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
