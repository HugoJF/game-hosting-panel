<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
	protected $fillable = ['id', 'stub', 'cover', 'name', 'description', 'nest_id'];

    public function nodes(): BelongsToMany
    {
        return $this->belongsToMany(Node::class);
	}

    public function getProcessor()
    {
        return app(config("processors.$this->stub"));
	}
}
