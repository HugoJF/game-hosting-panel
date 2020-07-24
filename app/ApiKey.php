<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiKey extends Model
{
	use Uuids;

	public $incrementing = false;

	protected $fillable = ['description'];

	protected $dates = ['last_used_at'];

	public function user(): BelongsTo
    {
		return $this->belongsTo(User::class);
	}
}
