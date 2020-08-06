<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */
    \App\Notifications\TransactionUpdated::class => [
        'setting' => 'notify_transaction_updated',
        'view'    => 'notifications.templates.transaction-updated',
    ],
    \App\Notifications\ServerDeployed::class     => [
        'setting' => 'notify_server_deployed',
        'view'    => 'notifications.templates.server-deployed',
    ],
];
