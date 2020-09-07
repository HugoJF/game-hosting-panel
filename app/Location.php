<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = ['id', 'short', 'long', 'flag'];

    public $incrementing = false;

    public function nodes(): HasMany
    {
        return $this->hasMany(Node::class);
    }
}
