<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['name', 'game_id', 'node_id', 'user_id',];

    protected $dates = ['installed_at'];

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

    public function currentDeploy()
    {
        return $this->deploys()->whereNull('terminated_at');
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
        if (($current = $this->currentDeploy)->count() > 1) {
            throw new Exception('Multiple non-terminated deploys, something is fucked');
        }

        return $current->first();
    }
}
