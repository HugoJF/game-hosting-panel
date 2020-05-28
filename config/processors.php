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

        'handler' => \App\Classes\CsgoProcessor::class,

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
                'options'     => ['128', '102.4', '64'],
            ],
            'slots'    => [
                'name'        => 'Slots',
                'icon'        => 'cpu',
                'description' => 'Estimated slot count',
                'empty_value' => 12,
                'options'     => ['12', '16', '20', '24', '28', '32', '36', '40'],
            ],
        ],
    ],
];
