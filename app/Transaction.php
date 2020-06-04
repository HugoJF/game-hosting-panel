<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Transaction extends Model implements Searchable
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

    public function order()
    {
        return $this->hasOne(Order::class);
	}

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->id
        );
    }
}
