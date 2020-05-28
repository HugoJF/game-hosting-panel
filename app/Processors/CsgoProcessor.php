<?php

namespace App\Processors;

use App\Exceptions\MissingTickrateCpuCost;

class CsgoProcessor extends Processor
{
    public function __construct()
    {
        $this->params = config('processors.csgo.parameters');
    }

    public function cost($parameters): array
    {
        $tickrateCostPerSlot = config('processors.csgo.cost_per_slot');

        if (!array_key_exists($parameters['tickrate'], $tickrateCostPerSlot)) {
            throw new MissingTickrateCpuCost;
        }

        $costPerSlot = $tickrateCostPerSlot[ $parameters['tickrate'] ] ?? null;

        return array_merge(config('processors.csgo.costs'), [
            'cpu' => (int) $parameters['slots'] * (int) $costPerSlot,
        ]);
    }

    function reject($cost): bool
    {
        // TODO: this should come from node
        return $cost['cpu'] > 2400;
    }
}
