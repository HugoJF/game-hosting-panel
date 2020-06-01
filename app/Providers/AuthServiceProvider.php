<?php

namespace App\Providers;

use App\ApiKey;
use App\Coupon;
use App\Game;
use App\Location;
use App\Order;
use App\Policies\ApiKeyPolicy;
use App\Policies\CouponPolicy;
use App\Policies\GamePolicy;
use App\Policies\LocationPolicy;
use App\Policies\NotificationPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ServerPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;
use App\Server;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Notification;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Notification::class => NotificationPolicy::class,
        User::class         => UserPolicy::class,
        Transaction::class  => TransactionPolicy::class,
        ApiKey::class       => ApiKeyPolicy::class,
        Coupon::class       => CouponPolicy::class,
        Order::class        => OrderPolicy::class,
        Server::class       => ServerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
