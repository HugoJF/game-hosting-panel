<?php

namespace App\Observers;

use App\Contracts\IGameDriver;
use App\Deploy;
use App\Transaction;
use Illuminate\Support\Facades\Auth;

class DeployObserver
{
	public function created(Deploy $deploy)
	{
		/** @var Transaction $transaction */
		$transaction = Transaction::make();

		$transaction->value = 0;
		$transaction->user()->associate(Auth::user());
		$transaction->reason()->associate($deploy);

		$transaction->save();

		$deploy->transaction()->associate($transaction);

		$deploy->save();

		$deploy->fireDeployed();
	}

	public function deployed(Deploy $deploy)
	{
		/** @var IGameDriver $driver */
		$driver = $deploy->server->driver();

		$driver->setup($deploy);

		$driver->start();
	}

	public function started(Deploy $deploy)
	{
		/** @var IGameDriver $driver */
		$driver = $deploy->server->driver();

		$driver->setup($deploy);

		$driver->start();
	}

	public function stopped(Deploy $deploy)
	{
		/** @var IGameDriver $driver */
		$driver = $deploy->server->driver();

		$driver->stop();
	}

	public function terminated(Deploy $deploy)
	{
		/** @var IGameDriver $driver */
		$driver = $deploy->server->driver();

		$driver->stop();
	}
}
