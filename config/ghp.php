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
    'termination-reasons' => [
        'TERMINATED_BY_ADMIN',
        'TERMINATED_BY_USER',
        'INSUFFICIENT_BALANCE',
        'INSUFFICIENT_RESOURCES',
    ],

    'cost-multiplier' => [
        'minutely' => 1 / (30 * 24 * 60) * 20,
        'hourly'   => 1 / (30 * 24) * 10,
        'daily'    => 1 / 30 * 4,
        'weekly'   => 1 / 4 * 1.5,
        'monthly'  => 1,
    ],

    'billing-periods' => [
        'minutely',
        'hourly',
        'daily',
        'weekly',
        'monthly',
    ],
];
