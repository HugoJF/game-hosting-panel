<?php

namespace App\Processors;

use App\Exceptions\MissingTickrateCpuCost;

class CsgoProcessor extends Processor
{
    public function __construct()
    {
        $this->params = config('processors.csgo.parameters');
    }

    public function cost($cost): array
    {
        $tickrateCostPerSlot = config('processors.csgo.cost_per_slot');

        if (!array_key_exists($cost['tickrate'], $tickrateCostPerSlot)) {
            throw new MissingTickrateCpuCost;
        }

        $costPerSlot = $tickrateCostPerSlot[ $cost['tickrate'] ] ?? null;

        return [
            ...config('processors.csgo.costs'),
            ...[
                'cpu' => (int) $cost['slots'] * (int) $costPerSlot,
            ],
        ];
    }

    function reject($cost): bool
    {
        // TODO: this should come from node
        return $cost['cpu'] > 2400;
    }
}
