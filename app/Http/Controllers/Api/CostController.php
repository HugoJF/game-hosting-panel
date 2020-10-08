<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidBillingPeriodException;
use App\Game;
use App\Http\Controllers\Controller;
use App\Location;
use App\Node;
use App\Server;
use App\Services\ConfigurerService;
use App\Services\User\DeployCostService;
use App\Services\User\NodeSelectionService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CostController extends Controller
{
    protected DeployCostService $deployCost;
    protected NodeSelectionService $nodeSelection;

    public function __construct(
        DeployCostService $deployCost,
        NodeSelectionService $nodeSelection
    )
    {
        $this->deployCost = $deployCost;
        $this->nodeSelection = $nodeSelection;
    }

    public function creation(Request $request)
    {
        $game = Game::findOrFail($request->get('game'));
        $location = Location::findOrFail($request->get('location'));

        $node = $this->nodeSelection->handle($location, $game);

        return $this->cost($game, $node, $request->all());
    }

    public function deployment(Request $request)
    {
        $server = Server::query()->where('hash', $request->input('server'))->first();

        return $this->cost($server->game, $server->node, $request->all());
    }

    protected function cost(Game $game, Node $node, array $form)
    {
        /** @var ConfigurerService $configurerService */
        $configurerService = app(ConfigurerService::class);

        if (!$period = $form['billing_period'] ?? null) {
            throw new InvalidBillingPeriodException($period);
        }

        $cost = $configurerService->formToCost($game, $node, $form);

        return [
            'node_id' => $node->id,
            'cost'    => $this->deployCost->getCostPerPeriod($node, $period, $cost),
        ];
    }
}
