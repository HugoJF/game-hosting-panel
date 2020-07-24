<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['id', 'short', 'long', 'flag'];

    public function nodes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Node::class);
    }
}
