<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists('save')) {
    function save(Model $model)
    {
        return tap($model)->save();
    }
}
