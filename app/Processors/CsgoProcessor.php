<?php

namespace App\Processors;

use App\Exceptions\MissingTickrateCpuCost;
use Illuminate\Validation\Rule;

class CsgoProcessor extends Processor
{
    public function __construct()
    {
        $this->params = config('processors.csgo.parameters');
    }

    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        $tickrates = array_keys(config('processors.csgo.parameters.tickrate.options'));
        $slots = array_keys(config('processors.csgo.parameters.slots.options'));
        $databases = array_keys(config('processors.csgo.parameters.databases.options'));

        return [
            'tickrate'  => ['required', 'numeric', Rule::in($tickrates)],
            'slots'     => ['required', 'numeric', Rule::in($slots)],
            'databases' => ['required', 'numeric', Rule::in($databases)],
        ];
    }

    /**
     * @inheritDoc
     */
    public function cost(array $config): array
    {
        $tickrateCostPerSlot = config('processors.csgo.cost_per_slot');
        $costPerSlot = (int) $tickrateCostPerSlot[ $config['tickrate'] ];
        $slots = (int) $config['slots'];
        $databases = (int) $config['databases'];

        $staticCosts = config('processors.csgo.costs');
        $dynamicCosts = [
            'cpu'       => $slots * $costPerSlot,
            'databases' => $databases,
        ];

        return array_merge($staticCosts, $dynamicCosts);
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
