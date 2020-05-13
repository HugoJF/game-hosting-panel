<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	protected $fillable = ['id', 'stub', 'cover', 'name', 'description', 'nest_id'];

    public function nodes()
    {
        return $this->belongsToMany(Node::class);
	}
}
