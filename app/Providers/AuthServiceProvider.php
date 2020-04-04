<?php

namespace App\Providers;

use App\ApiKey;
use App\Coupon;
use App\Game;
use App\Policies\ApiKeyPolicy;
use App\Policies\CouponPolicy;
use App\Policies\GamePolicy;
use App\Policies\LocationPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\UserPolicy;
use App\Location;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		// 'App\Model' => 'App\Policies\ModelPolicy',
		User::class        => UserPolicy::class,
		Transaction::class => TransactionPolicy::class,
		ApiKey::class      => ApiKeyPolicy::class,
		Location::class      => LocationPolicy::class,
		Game::class        => GamePolicy::class,
		Coupon::class      => CouponPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();
		//
	}
}
