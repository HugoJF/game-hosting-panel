<?php

namespace App\Processors;

class Cod4Processor extends Processor
{
    public function __construct()
    {
        $this->parameters = config('processors.cod4.parameters');
    }

    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        return [
            'slots' => 'required|numeric|gte:10|lte:64',
        ];
    }

    public function calculateResourceCost(array $config): array
    {
        $slots = (int) $config['slots'];
        $costPerSlots = (int) config('processors.cod4.cost_per_slot');

        return array_merge(
            config('processors.cod4.costs'),
            [
                'cpu' => 50 + $slots * $costPerSlots // TODO: magic variables nop
            ],
        );
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
