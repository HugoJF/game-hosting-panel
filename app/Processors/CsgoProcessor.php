<?php

namespace App\Processors;

class CsgoProcessor extends Processor
{
    /**
     * @inheritDoc
     */
    public function calculateResourceCost(array $config): array
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

    public function formToStartupConfig(array $form): string
    {
        $tickrate = $form['tickrate'];
        $slots = $form['slots'];

        $parts = [
            './srcds_run',
            '-game csgo',
            '-console',
            '-port {{SERVER_PORT}}',
            '+ip 0.0.0.0',
            '+map {{SRCDS_MAP}}',
            '-strictportbind',
            '-norestart',
            "-tickrate $tickrate",
            "-maxplayers_override $slots",
            '+sv_setsteamaccount {{STEAM_ACC}}',
        ];

        return implode(' ', $parts);
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
