<?php

namespace App\Classes;

class CsgoSpecCalculatorV2 extends SpecCalculator
{
    protected $tickrate = [
        'empty_value' => '64',
        'options'     => ['128', '102.4', '64'],
    ];

    protected $slots = [
        'empty_value' => 12,
        'options'     => ['12', '16', '20', '24', '28', '32', '36', '40'],
    ];

    protected $gotv = [
        'empty_value' => false,
        'options'     => [true, false],
    ];

    protected $params = [
        'tickrate',
        'slots',
        'gotv',
    ];

    public function cost($parameters): array
    {
        $tickrateCostPerSlot = [
            '64'    => 60,
            '102.4' => 80,
            '128'   => 100,
        ];

        $gotvMultiplier = $parameters['gotv'] ? 1.2 : 1;

        $costPerSlot = $tickrateCostPerSlot[ $parameters['tickrate'] ];

        // TODO: implementar para memory/disk/databases
        return [
            'cpu' => (int) $parameters['slots'] * (int) $costPerSlot * $gotvMultiplier,
        ];
    }

    public function c($choices = [])
    {
        dd([
            'options' => $this->calculate($choices),
        ]);
    }

    function reject($cost): bool
    {
        return $cost['cpu'] > 2400;
    }
}
