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
            'memory' => 1000,
            'disk'   => 27000,
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
            'tickrate'  => [
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
            'slots'     => [
                'name'        => 'Slots',
                'icon'        => 'cpu',
                'description' => 'Estimated slot count',
                'empty_value' => '12',
                'options'     => [
                    '10' => '10',
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
            'databases' => [
                'name'        => 'Databases',
                'icon'        => 'cpu',
                'description' => 'Maximum databases',
                'empty_value' => '0',
                'options'     => [
                    '0' => '0',
                    '1' => '1',
                ],
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Server card parameters
        |--------------------------------------------------------------------------
        */

        'card' => [
            'slots'    => [
                'name'   => 'words.slots',
                'icon'   => 'archive',
                'suffix' => 'players',
            ],
            'tickrate' => [
                'name'   => 'words.tickrate',
                'icon'   => 'cpu',
                'suffix' => 'ticks/sec',
            ],
        ],
    ],

    'cod4' => [
        /*
        |--------------------------------------------------------------------------
        | Processor class
        |--------------------------------------------------------------------------
        */

        'handler' => \App\Processors\Cod4Processor::class,

        /*
        |--------------------------------------------------------------------------
        | Static resource cost
        |--------------------------------------------------------------------------
        */

        'costs' => [
            'memory'    => 512,
            'disk'      => 8000,
            'databases' => 0,
        ],

        /*
        |--------------------------------------------------------------------------
        | CPU mark cost per slot
        |--------------------------------------------------------------------------
        */

        'cost_per_slot' => 30,

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
            'slots' => [
                'name'        => 'Slots',
                'icon'        => 'cpu',
                'description' => 'Estimated slot count',
                'empty_value' => '10',
                'options'     => [
                    '10' => '10',
                    '12' => '12',
                    '14' => '14',
                    '16' => '16',
                    '18' => '18',
                    '20' => '20',
                    '24' => '24',
                    '28' => '28',
                    '32' => '32',
                    '40' => '40',
                    '48' => '48',
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
        | Parameters configuration that are used by the processor to
        | dynamically generate and filter parameters for the game server.
        |
        */

        'parameters' => [
            'cpu'       => [
                'name'        => 'CPU',
                'icon'        => 'cpu',
                'description' => 'Maximum CPU performance',
                'empty_value' => '1200',
                'options'     => [
                    '1200' => '1200 marks',
                    '1800' => '1800 marks',
                    '2400' => '2400 marks',
                    '3600' => '3600 marks',
                ],
            ],
            'memory'    => [
                'name'        => 'Memory',
                'icon'        => 'memory',
                'description' => 'Maximum RAM allocation',
                'empty_value' => '1000',
                'options'     => [
                    '1000' => '1 GB',
                    '1500' => '1,5 GB',
                    '2000' => '2 GB',
                    '2500' => '2,5 GB',
                    '3000' => '3 GB',
                ],
            ],
            'disk'      => [
                'name'        => 'Disk',
                'icon'        => 'disk',
                'description' => 'Maximum disk usage',
                'empty_value' => '500',
                'options'     => [
                    '500'  => '500 MB',
                    '1000' => '1 GB',
                    '2000' => '2 GB',
                    '3000' => '3 GB',
                    '4000' => '4 GB',
                    '5000' => '5 GB',
                ],
            ],
            'databases' => [
                'name'        => 'Databases',
                'icon'        => 'databases',
                'description' => 'Maximum databases allowed',
                'empty_value' => '0',
                'options'     => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
            ],
        ],
    ],
];
