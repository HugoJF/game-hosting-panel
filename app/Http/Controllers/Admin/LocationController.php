<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Location;

class LocationController extends Controller
{
    public function show(Location $location)
    {
        return view('admins.locations.show', compact('location'));
    }
}
