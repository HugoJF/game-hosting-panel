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
		$transaction = new Transaction;

		$transaction->value = 0;
		$transaction->user()->associate($deploy->server->user);
		$transaction->reason()->associate($deploy);

		$transaction->save();

		$deploy->transaction()->associate($transaction);

		$deploy->save();
	}
}
