<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Location;
use App\Node;
use App\Server;
use App\Services\User\DeployCostService;
use App\Services\User\NodeSelectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CostController extends Controller
{
    /**
     * @var DeployCostService
     */
    protected $deployCost;

    /**
     * @var NodeSelectionService
     */
    protected $nodeSelection;

    public function __construct(
        DeployCostService $deployCost,
        NodeSelectionService $nodeSelection
    )
    {
        $this->deployCost = $deployCost;
        $this->nodeSelection = $nodeSelection;
    }

    public function creation(Request $request, Location $location)
    {
        $location = Location::find($request->get('location'));
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

        $data = collect($specs)->mapWithKeys(function ($spec) use ($config) {
            return [$spec => Arr::get($config, $spec, 0)];
        })->toArray();

        if ($period = $config['period'] ?? null) {
            return [
                'node_id' => $node->id,
                'cost'    => $this->deployCost->getCostPerPeriod($node, $period, $data),
            ];
        } else {
            return 0;
        }
    }
}
