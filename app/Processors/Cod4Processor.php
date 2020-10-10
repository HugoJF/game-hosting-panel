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
        $slots = $form['slots'];

        $parts = [
            './cod4x18_dedrun',
            '+map {{COD_MAP}}',
            '+set dedicated 2',
            '+exec {{COD_CFG}}',
            '+map_rotate',
            '+set net_ip {{SERVER_IP}}',
            '+set net_port {{SERVER_PORT}}',
            '+set sv_maxclients {{COD_MAXPLAYERS}}',
            "+set sv_maxclients $slots",
            '+set sv_authtoken {{COD_AUTH}}'
        ];

        return implode(' ', $parts);
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
