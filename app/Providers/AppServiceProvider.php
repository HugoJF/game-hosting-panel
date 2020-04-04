<?php

namespace App\Providers;

use App\Coupon;
use App\Deploy;
use App\Observers\DeployObserver;
use App\Observers\OrderObserver;
use App\Observers\ServerObserver;
use App\Order;
use App\Server;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->app->environment() !== 'production') {
			$this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
		}
		// ...
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
	    $this->registerSingletons();
		$this->registerObservers();
		$this->registerCustomBladeDirectives();
		$this->registerCustomRouteBindinds();
	}

    protected function registerSingletons()
    {
        $this->app->singleton(Pterodactyl::class, function ($app) {
            return new Pterodactyl(config('pterodactyl.api.key'), config('pterodactyl.api.endpoint'));
        });
    }

    protected function registerObservers(): void
	{
		Deploy::observe(DeployObserver::class);
		Order::observe(OrderObserver::class);
	}

    protected function registerCustomBladeDirectives(): void
	{
		Blade::if ('admin', function () {
			return auth()->check() && auth()->user()->admin;
		});
	}

    protected function registerCustomRouteBindinds(): void
	{
		Route::bind('coupon', function ($value) {
			return Coupon::where('code', $value)->first() ?? abort(404);
		});
	}
}
