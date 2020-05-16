<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Location;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        $locations = Location::all();
        $servers = $user->servers()->with(['game', 'node', 'deploys'])->get();

        return view('dashboard', compact('servers', 'locations'));
    }

    public function faq()
    {
        // TODO: implement FAQ
        return 'todo';
    }
}
