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

    \App\Notifications\ServerCreated::class      => [
        'setting' => 'notify_server_created',
        'view'    => 'notifications.templates.server-created',
    ],

    \App\Notifications\ServerInstalled::class    => [
        'setting' => 'notify_server_installed',
        'view'    => 'notifications.templates.server-installed',
    ],

];
