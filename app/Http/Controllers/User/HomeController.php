<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Location;
use App\Server;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Reflash messages to avoid them disappearing
        $request->session()->reflash();

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
            ->registerModel(Server::class, 'name', 'ip')
            ->search($request->input('term'));

        // Information about each model being searched
        $mapping = [
            'servers' => [
                'title'    => __('words.servers'),
                'view'     => 'cards.servers',
                'variable' => 'servers',
            ],
        ];

        // Pluck Models from each type group
        $result = $result->groupByType()->mapWithKeys(function (Collection $type, $key) {
            return [$key => $type->pluck('searchable')];
        });

        return view('search', compact('result', 'mapping'));
    }

    public function faq()
    {
        // TODO: implement FAQ
        return 'todo';
    }
}
