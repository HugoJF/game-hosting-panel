<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use Uuids;

	public $incrementing = false;

	protected $observables = ['paid'];

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(User::class);
	}

	public function transaction(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
		return $this->belongsTo(Transaction::class);
	}

	public function firePaid(): void
    {
		$this->fireModelEvent('paid');
	}
}
