<?php

namespace App\Processors;

class Cod4Processor extends Processor
{
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

    /**
     * @inheritDoc
     */
    public function formToStartupConfig(array $form): ?string
    {
        return null;
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
