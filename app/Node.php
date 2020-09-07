<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Node extends Model
{
    protected $fillable = ['id', 'name', 'description', 'location_id',
        'cpu_cost', 'memory_cost', 'disk_cost', 'database_cost',
        'cpu_limit', 'memory_limit', 'disk_limit', 'database_limit',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }
}
