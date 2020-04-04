<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Deploy extends Model
{
	protected $dates = ['terminated_at'];

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
		$billingPeriod = $this->billing_period;

		$differMap = [
			'minutely'  => 'diffInMinutes',
			'hourly'  => 'diffInHours',
			'daily'   => 'diffInDays',
			'weekly'  => 'diffInWeeks',
			'monthly' => 'diffInMonths',
		];

		$differ = $differMap[ $billingPeriod ];

		if ($this->terminated_at) {
			$base = $this->terminated_at;
		} else {
			$base = Carbon::now();
		}

		$duration = $base->$differ($this->created_at) + 1;

		return $duration;
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
