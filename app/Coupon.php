<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Coupon extends Model
{
	protected $fillable = ['code', 'value', 'max_uses'];

	public function getRouteKeyName()
	{
		return 'code';
	}

	public function users()
	{
		return $this->belongsToMany(User::class)->withTimestamps();
	}

	public function transaction()
	{
		return $this->morphOne(Transaction::class, 'reason');
	}

	public function getUsesAttribute()
	{
		return $this->users()->count();
	}
}
