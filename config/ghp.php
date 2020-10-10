<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'released' => env('RELEASED', false),

    'limits'   => [
        'cpu'       => 2400,
        'memory'    => 3072,
        'disk'      => 50000,
        'databases' => 3,
    ],

    'termination-reasons' => [
        'TERMINATED_BY_ADMIN',
        'FORCE_TERMINATED_BY_USER',
        'TERMINATED_BY_USER',
        'SERVER_DELETED',
        'INSUFFICIENT_BALANCE',
        'INSUFFICIENT_RESOURCES',
    ],

    'cost-multiplier' => [
        'minutely' => 1 / (30 * 24 * 60) * 20,
        'hourly'   => 1 / (30 * 24) * 7,
        'daily'    => 1 / 30 * 3,
        'weekly'   => 1 / 4 * 1.25,
        'monthly'  => 1,
    ],

    'billing-periods' => [
        'minutely' => false,
        'hourly'   => true,
        'daily'    => true,
        'weekly'   => true,
        'monthly'  => false,
    ],
];
