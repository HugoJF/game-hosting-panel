<?php

namespace App;

use App\Services\ServerService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Server extends Model implements Searchable
{
    use SoftDeletes;

    protected $fillable = ['name', 'game_id', 'node_id', 'user_id'];

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

    /** @deprecated */
    public function getDeploy()
    {
        return app(ServerService::class)->getCurrentDeploy($this);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->name,
            route('servers.show', $this->id)
        );
    }
}
