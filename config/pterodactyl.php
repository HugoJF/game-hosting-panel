<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pterodactyl URL
    |--------------------------------------------------------------------------
    |
    | Pls don't terminate with /
    |
    | This is not used on APIs, just to link users to the dashboard
    |
    */

    'url' => 'http://panel.test',

    /*
    |--------------------------------------------------------------------------
    | Pterodactyl API credentials
    |--------------------------------------------------------------------------
    */
    'api' => [
        'endpoint' => env('PTERODACTYL_API_ENDPOINT'),
        'key'      => env('PTERODACTYL_API_KEY'),
    ],

    'client' => [
        'key' => env('PTERODACTYL_CLIENT_KEY'),
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
            'memory' => 10,
            'swap'   => 10,
            'io'     => 10,
            'cpu'    => 10,
            'disk'   => 1,
        ],
        'feature_limits' => [
            'databases'   => 0,
            'allocations' => 1,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Server deployment default parameters
    |--------------------------------------------------------------------------
    |
    | Defaults parameters used when a server is deployed
    |
    */

    'server-deployment-defaults' => [
        'limits' => [
            'io' => 500,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Server termination default parameters
    |--------------------------------------------------------------------------
    |
    | Defaults parameters used when a server is terminated
    |
    */

    'server-termination-defaults' => [
        'limits'         => [
            'memory' => 10,
            'swap'   => 10,
            'io'     => 10,
            'cpu'    => 10,
            'disk'   => 1,
        ],
    ],
];
