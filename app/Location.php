<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['id', 'short', 'long', 'flag'];

    public function nodes()
    {
        return $this->hasMany(Node::class);
    }
}
