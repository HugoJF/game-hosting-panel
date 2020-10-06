<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;
use App\Location;
use App\Server;
use App\Services\ConfigurerService;
use App\Services\GameService;
use App\Services\User\NodeSelectionService;
use Illuminate\Http\Request;

class ConfigurerController extends Controller
{
    public function periods(ConfigurerService $service)
    {
        return $service->periods();
    }

    public function games(ConfigurerService $service)
    {
        return $service->games();
    }

    public function locations(ConfigurerService $service)
    {
        return $service->locations();
    }

    public function gameLocations(ConfigurerService $service, Game $game)
    {
        return $service->gameLocations($game);
    }

    /** @deprecated */
    public function currentForm(Server $server)
    {
        return $server->form;
    }

    public function parameters(
        NodeSelectionService $nodeSelection,
        ConfigurerService $configurerService,
        Request $request,
        Game $game,
        Location $location
    ): array {
        $node = $nodeSelection->handle($game);

        return $configurerService->parameterSelection($game, $node, $request->all());
    }
}
