<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Location;
use App\Server;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Searchable\Search;
use Spatie\Searchable\SearchResult;

class HomeController extends Controller
{
    public function index(Request $request)
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

    public function search(Request $request)
    {
        $result = (new Search)
            ->registerModel(Server::class, 'name')
            ->search($request->input('term'));

        return view('search', compact('result'));
    }

    public function faq()
    {
        // TODO: implement FAQ
        return 'todo';
    }
}
