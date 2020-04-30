<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Location;
use App\Node;
use App\Services\User\DeployCostService;
use App\Services\User\NodeSelectionService;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function cost(
        DeployCostService $costService,
        NodeSelectionService $nodeSelection,
        Request $request,
        Location $location
    )
    {
        $node = $nodeSelection->handle($location);

        $defaults = [
            'cpu'       => 0,
            'memory'    => 0,
            'disk'      => 0,
            'databases' => 0,
        ];
        $params = $request->only([
            'cpu', 'memory', 'disk', 'databases',
        ]);

        $data = array_merge($defaults, $params);

        return $costService->getCostPerPeriod($node, $request->get('period'), $data);
    }
}
