<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Coupon extends Model
{
	protected $fillable = ['code', 'value', 'max_uses'];

	public function getRouteKeyName(): string
	{
		return 'code';
	}

	public function users(): BelongsToMany
    {
		return $this->belongsToMany(User::class)->withTimestamps();
	}

	public function transaction(): MorphOne
    {
		return $this->morphOne(Transaction::class, 'reason');
	}

	public function getUsesAttribute()
	{
		return $this->users()->count();
	}
}
