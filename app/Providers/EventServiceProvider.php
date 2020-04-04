<?php

namespace App\Providers;

use App\Events\CouponUsed;
use App\Listeners\CreateCouponTransaction;
use App\Listeners\RegisterUserOnPanel;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		Registered::class         => [
			SendEmailVerificationNotification::class,
            RegisterUserOnPanel::class,
		],
		SocialiteWasCalled::class => [
			'SocialiteProviders\\Steam\\SteamExtendSocialite@handle',
		],
        CouponUsed::class => [
            CreateCouponTransaction::class,
        ]
	];

	/**
	 * Register any events for your application.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();
		//
	}
}
