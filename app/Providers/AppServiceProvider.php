<?php

namespace App\Providers;

use App\Classes\PterodactylClient;
use App\Coupon;
use App\Deploy;
use App\GlobalComposer;
use App\Observers\DeployObserver;
use App\Observers\OrderObserver;
use App\Observers\TransactionObserver;
use App\Order;
use App\Transaction;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
			$this->app->register(IdeHelperServiceProvider::class);
		}
		// ...
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot(): void
    {
        Schema::defaultStringLength(191);

	    $this->registerSingletons();
		$this->registerObservers();
		$this->registerCustomBladeDirectives();
		$this->registerCustomRouteBindings();
		$this->registerViewComposers();
	}

    protected function registerSingletons(): void
    {
        $this->app->singleton(Pterodactyl::class, function ($app) {
            return new Pterodactyl(config('pterodactyl.api.key'), config('pterodactyl.api.endpoint'));
        });

        $this->app->singleton(PterodactylClient::class, function ($app) {
            return new PterodactylClient(config('pterodactyl.client.key'), config('pterodactyl.api.endpoint'));
        });
    }

    protected function registerObservers(): void
	{
		Deploy::observe(DeployObserver::class);
		Order::observe(OrderObserver::class);
		Transaction::observe(TransactionObserver::class);
	}

    protected function registerCustomBladeDirectives(): void
	{
		Blade::if ('admin', function () {
			return auth()->check() && auth()->user()->admin;
		});
	}

    protected function registerCustomRouteBindings(): void
	{
		Route::bind('coupon', function ($value) {
			return Coupon::where('code', $value)->first() ?? abort(404);
		});
	}

    protected function registerViewComposers(): void
    {
        view()->composer('*', GlobalComposer::class);
    }
}
