<?php

namespace App\Processors;

use Illuminate\Validation\Rule;

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

        $parts = [
            'java',
            '-Xms128M',
            "--tickrate $tickrate",
            '-Xmx{{SERVER_MEMORY}}M',
            '-Dterminal.jline=false',
            '-Dterminal.ansi=true',
            '-jar',
            '{{SERVER_JARFILE}}',
        ];

        return implode(' ', $parts);
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
