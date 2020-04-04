<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = ['id', 'name', 'description', 'location_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
