<?php

namespace App\Classes;

class CsgoSpecCalculator extends SpecCalculator
{
    protected $params = [
        'tickrate' => [
            'name'        => 'Tickrate',
            'icon'        => 'cpu',
            'description' => 'Maximum player count',
            'empty_value' => '64',
            'options'     => ['128', '102.4', '64'],
        ],
        'slots'    => [
            'name'        => 'Slots',
            'icon'        => 'cpu',
            'description' => 'Estimated slot count',
            'empty_value' => 12,
            'options'     => ['12', '16', '20', '24', '28', '32', '36', '40'],
        ],
    ];

    public function cost($parameters): array
    {
        $tickrateCostPerSlot = [
            '64'    => 90,
            '102.4' => 120,
            '128'   => 150,
        ];

        $costPerSlot = $tickrateCostPerSlot[ $parameters['tickrate'] ];

        return [
            'cpu'       => (int) $parameters['slots'] * (int) $costPerSlot,
            'memory'    => 1000,
            'disk'      => 27000,
            'databases' => 0,
        ];
    }

    function reject($cost): bool
    {
        // TODO: this should come from node
        return $cost['cpu'] > 2400;
    }
}
