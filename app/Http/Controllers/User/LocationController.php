<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();

        return view('locations.index', compact('locations'));
    }

    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }
}
