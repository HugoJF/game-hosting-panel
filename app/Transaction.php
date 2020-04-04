<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	use Uuids;

	public $incrementing = false;

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function deploys()
	{
		return $this->hasMany(Deploy::class);
	}

	public function reason()
	{
		return $this->morphTo();
	}
}
