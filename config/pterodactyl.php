<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pterodactyl API credentials
    |--------------------------------------------------------------------------
    |
    |
    |
    */
    'api' => [
        'endpoint' => env('PTERODACTYL_API_ENDPOINT'),
        'key'      => env('PTERODACTYL_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Server creation default parameters
    |--------------------------------------------------------------------------
    |
    | Defaults parameters used when a server is created
    |
    */

    'server-creation-defaults' => [
        'limits'         => [
            'memory' => 512,
            'swap'   => 256,
            'io'     => 100,
            'cpu'    => 10,
            'disk'   => 10,
        ],
        'feature_limits' => [
            'databases'   => 0,
            'allocations' => 1,
        ],
    ],
];
