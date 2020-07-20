<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['visible', 'type', 'description', 'action', 'action_url', 'expires_at'];

    protected $casts = [
        'visible' => 'boolean',
    ];
}
