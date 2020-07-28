<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Location;
use App\Node;
use App\Server;
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
        $location = Location::find($request->get('location'));

        if (!($location instanceof Location))  {
            throw new BadRequestException;
        }

        $node = $this->nodeSelection->handle($location);

        return $this->cost($node, $request->all());
    }

    public function deployment(Request $request)
    {
        $server = Server::find($request->input('server'));

        return $this->cost($server->node, $request->all());
    }

    protected function cost(Node $node, array $config)
    {
        $specs = ['cpu', 'memory', 'disk', 'databases'];

        $data = collect($specs)->mapWithKeys(fn($spec) => [
            $spec => $config[ $spec ] ?? 0,
        ])->toArray();

        if (!$period = $config['billing_period'] ?? null) {
            return null;
        }

        return [
            'node_id' => $node->id,
            'cost'    => $this->deployCost->getCostPerPeriod($node, $period, $data),
        ];
    }
}
