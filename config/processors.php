<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Game processors
    |--------------------------------------------------------------------------
    |
    | Links game stubs to parameter processor
    |
    */

    'csgo' => [
        /*
        |--------------------------------------------------------------------------
        | Processor class
        |--------------------------------------------------------------------------
        */

        'handler' => \App\Processors\CsgoProcessor::class,

        /*
        |--------------------------------------------------------------------------
        | Static resource cost
        |--------------------------------------------------------------------------
        */

        'costs' => [
            'memory'    => 1000,
            'disk'      => 27000,
            'databases' => 0,
        ],

        /*
        |--------------------------------------------------------------------------
        | CPU mark cost per slot
        |--------------------------------------------------------------------------
        */

        'cost_per_slot' => [
            '64'    => 90,
            '102.4' => 120,
            '128'   => 150,
        ],

        /*
        |--------------------------------------------------------------------------
        | Parameter information
        |--------------------------------------------------------------------------
        |
        | Parameter configuration that is used by the processor to
        | dynamically generate and filter parameters for the game server.
        |
        */

        'parameters' => [
            'tickrate' => [
                'name'        => 'Tickrate',
                'icon'        => 'cpu',
                'description' => 'Maximum player count',
                'empty_value' => '64',
                'options'     => [
                    '128'   => '128',
                    '102.4' => '102.4',
                    '64'    => '64',
                ],
            ],
            'slots'    => [
                'name'        => 'Slots',
                'icon'        => 'cpu',
                'description' => 'Estimated slot count',
                'empty_value' => '12',
                'options'     => [
                    '12' => '12',
                    '16' => '16',
                    '20' => '20',
                    '24' => '24',
                    '28' => '28',
                    '32' => '32',
                    '36' => '36',
                    '40' => '40',
                ],
            ],
        ],
    ],

    'minecraft' => [
        /*
        |--------------------------------------------------------------------------
        | Processor class
        |--------------------------------------------------------------------------
        */

        'handler' => \App\Processors\MinecraftProcessor::class,

        /*
        |--------------------------------------------------------------------------
        | Static resource cost
        |--------------------------------------------------------------------------
        */

        'costs' => [
            'databases' => 0,
        ],

        /*
        |--------------------------------------------------------------------------
        | MB of memory per player
        |--------------------------------------------------------------------------
        */

        'memory_per_player' => 32,

        /*
        |--------------------------------------------------------------------------
        | MB of disk per world size
        |--------------------------------------------------------------------------
        */

        'disk_per_size' => [
            'small'  => 1000,
            'medium' => 2000,
            'large'  => 5000,
            'huge'   => 10000,
        ],

        /*
        |--------------------------------------------------------------------------
        | Parameter information
        |--------------------------------------------------------------------------
        |
        | Parameter configuration that is used by the processor to
        | dynamically generate and filter parameters for the game server.
        |
        */

        'parameters' => [
            'slots'   => [
                'name'        => 'Slots',
                'icon'        => 'cpu',
                'description' => 'Maximum player count',
                'empty_value' => '10',
                'options'     => [
                    '10'  => '10',
                    '20'  => '20',
                    '30'  => '30',
                    '40'  => '40',
                    '50'  => '50',
                    '75'  => '75',
                    '100' => '100',
                ],
            ],
            'plugins' => [
                'name'        => 'Plugins',
                'icon'        => 'cpu',
                'description' => 'Amount of plugins',
                'empty_value' => '0',
                'options'     => [
                    '0'  => '0',
                    '5'  => '5',
                    '10' => '10',
                    '25' => '25',
                    '50' => '50',
                ],
            ],
            'size'    => [
                'name'        => 'World size',
                'icon'        => 'cpu',
                'description' => 'World size',
                'empty_value' => 'small',
                'options'     => [
                    'small'  => 'Small',
                    'medium' => 'Medium',
                    'large'  => 'Large',
                    'huge'   => 'Huge',
                ],
            ],
        ],
    ],
];
