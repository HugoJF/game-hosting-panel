<?php

namespace App;

use App\Services\User\DeployCostService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Deploy extends Model
{
	protected $dates = ['termination_requested_at', 'terminated_at'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

	public function server()
	{
		return $this->belongsTo(Server::class);
	}


	public function billablePeriod()
	{
	    /** @var DeployCostService $service */
	    $service = app(DeployCostService::class);

	    return $service->getBillablePeriod($this);
	}

	public function updateTransaction(): void
	{
		/** @var Server $server */
		$server = $this->server;

		$driver = $server->driver();

		$duration = $this->billablePeriod();

		$cost = $driver->cost($this, $duration);

		$balance = $this->server->user->balance;
		$transaction = $this->transaction;

		$delta = $cost - abs($transaction->value);

		// User set deploy to terminate are we are wait for it to finish it's paid period
		if ($this->terminated && $delta > 0) {
			$this->terminate();
		}

		// Check if user has enough money to start a new period
		if ($balance < $delta) {
			$this->terminate();
		} else {
			$transaction->value = -$cost;

			$transaction->save();
		}
	}
}
