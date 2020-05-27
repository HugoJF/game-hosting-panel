<?php

namespace App\Classes;

class CsgoSpecCalculator
{
    private $rules = [
        'step' => 2,
        '64' => [
            'min-slot' => ''
        ],
    ];


    private $maps = [
        '64'    => [
            24, 26,
        ],
        '102.4' => [
                20, 22,
        ],
        '128'   => [
            12, 14, 16, 18,
        ],
    ];

    public function calculate($mode = 'simple', $tickrate = null, $slots = null)
    {
        // 1270v6 -> 2400
        // 2630v4 -> 1800

        // $slot * $tickrateSlotCost * $gotvMultiplier;

        // 1 slot 128 -> 100
        // 1 slot 102 -> 80
        // 1 slot 64  -> 60

        // seleciona 128 tick:
        // calcular os slots com o custo 100

        // seleciona 64 tick:
        // calcular os slots com custo 60

        // seleciona 10 slots:
        // calcula quais tickrates da pra encaixar

        // 102.4 tick + 20 slots = % de CPU

        $tickrateToSlots = collect($this->maps);

        if ($tickrate = (float) $tickrate) {
            $slotOptions = $tickrateToSlots->reject(function ($group, $tr) use ($tickrate) {
                return ((float) $tr) < $tickrate;
            })->flatten(1)->mapWithKeys(function ($val) {
                return [$val => $val];
            });
        } else {
            $slotOptions = $tickrateToSlots->flatten(1);
        }

        $slotOptions = $slotOptions->mapWithKeys(function ($val) {
            return [$val => $val];
        })->toArray();

        if ($slots = (int) $slots) {
            $maxPerTick = $tickrateToSlots->mapWithKeys(function ($group, $tr) {
                return [$tr => collect($group)->max()];
            });

            $tickrateOptions = $maxPerTick->reject(function ($max) use ($slots) {
                return $slots > $max;
            });
        } else {
            $tickrateOptions = $tickrateToSlots->keys()->mapWithKeys(function ($i) {
                return [$i => $i];
            });
        }

        $tickrateOptions = $tickrateOptions->mapWithKeys(function ($v, $k) {
            return [$k => $k];
        })->toArray();

        if ($mode === 'simple') {
            return [
                'slots'    => [
                    'name'        => 'Slots',
                    'icon'        => 'cpu',
                    'description' => 'Maximum player count',
                    'options'     => $slotOptions,
                ],
                'tickrate' => [
                    'name'        => 'Tickrate',
                    'icon'        => 'cpu',
                    'description' => 'Server tickrate',
                    'options'     => $tickrateOptions,
                ],
            ];
        }

        return [
            'cpu'       => [
                'name'        => 'CPU',
                'icon'        => 'cpu',
                'description' => 'Maximum core usage',
                'options'     => [
                    '25'  => '25%',
                    '50'  => '50%',
                    '75'  => '75%',
                    '100' => '100%',
                ],
            ],
            'memory'    => [
                'name'        => 'Memory',
                'icon'        => 'memory',
                'description' => 'Maximum memory usage',
                'options'     => [
                    '1000' => '1 GB',
                    '2000' => '2 GB',
                    '3000' => '3 GB',
                    '4000' => '4 GB',
                    '5000' => '5 GB',
                ],
            ],
            'disk'      => [
                'name'        => 'Disk',
                'icon'        => 'disk',
                'description' => 'Maximum disk usage',
                'options'     => [
                    '5000'  => '5 GB',
                    '10000' => '10 GB',
                    '20000' => '20 GB',
                    '30000' => '30 GB',
                    '40000' => '40 GB',
                    '50000' => '50 GB',
                ],
            ],
            'databases' => [
                'name'        => 'Databases',
                'icon'        => 'databases',
                'description' => 'Maximum database tables',
                'options'     => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
            ],
        ];
    }
}
