<?php

namespace App\Observers;

use App\Deploy;
use App\Services\User\DeployCostService;
use App\Transaction;

class DeployObserver
{
	public function created(Deploy $deploy)
	{
	    /** @var DeployCostService $costService */
	    $costService = app(DeployCostService::class);

	    $transaction = new Transaction;

		$transaction->value = -$costService->getDeployCost($deploy);
		$transaction->user()->associate($deploy->server->user);
//		$transaction->reason()->associate($deploy);

		$transaction->save();

		$deploy->transaction()->associate($transaction);

		$deploy->save();
	}
}
