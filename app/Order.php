<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use Uuids;

	public $incrementing = false;

	protected $observables = ['paid'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function transaction()
	{
		return $this->morphOne(Transaction::class, 'reason');
	}

	public function firePaid()
	{
		$this->fireModelEvent('paid');
	}
}
