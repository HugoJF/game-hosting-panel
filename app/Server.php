<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Server extends Model implements Searchable
{
    use SoftDeletes;

    protected $fillable = ['name', 'game_id', 'node_id', 'user_id', 'billing_period'];

    protected $dates = ['installed_at', 'removed_at'];

    public function getRouteKeyName()
    {
        return 'hash';
    }

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function deploys()
    {
        return $this->hasMany(Deploy::class);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Deploy::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDeploy()
    {
        $this->loadMissing('deploys');
        $deploys = $this->deploys->where('terminated_at', null);

        if ($deploys->count() > 1) {
            throw new Exception('Multiple non-terminated deploys, something is fucked');
        }

        return $deploys->first();
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('servers.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
