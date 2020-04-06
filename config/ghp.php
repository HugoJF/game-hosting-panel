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

    'billing-periods' => [
        'minutely',
        'hourly',
        'daily',
        'weekly',
        'monthly',
    ],
];
