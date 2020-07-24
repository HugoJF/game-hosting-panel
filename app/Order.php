<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
	use Uuids;

	public $incrementing = false;

	protected $observables = ['paid'];

	public function user(): BelongsTo
    {
		return $this->belongsTo(User::class);
	}

	public function transaction(): BelongsTo
    {
		return $this->belongsTo(Transaction::class);
	}

	public function firePaid(): void
    {
		$this->fireModelEvent('paid');
	}
}
