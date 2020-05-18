<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Game;
use App\Http\Controllers\Controller;
use App\Location;
use App\Node;
use App\Server;
use App\Transaction;
use App\User;

class AdminController extends Controller
{
	const PAGINATE_SIZE = 5;

	public function dashboard()
	{
		$locations = Location::query()->latest()->limit(self::PAGINATE_SIZE)->get();
        $games = Game::query()->latest()->limit(self::PAGINATE_SIZE)->get();
        $nodes = Node::query()->latest()->limit(self::PAGINATE_SIZE)->get();
		$servers = Server::query()->latest()->limit(self::PAGINATE_SIZE)->get();
		$transactions = Transaction::query()->latest()->limit(self::PAGINATE_SIZE)->get();
		$coupons = Coupon::query()->latest()->limit(self::PAGINATE_SIZE)->get();
		$users = User::query()->latest()->limit(self::PAGINATE_SIZE)->get();

		return view('admins.dashboard', compact(
			'locations',
            'games',
            'nodes',
			'servers',
			'transactions',
			'coupons',
			'users'
		));
	}

	public function games()
	{
		$games = Game::paginate(self::PAGINATE_SIZE);

		return view('admins.games', compact('games'));
	}

	public function locations()
	{
		$locations = Location::query()->paginate(self::PAGINATE_SIZE);

		return view('admins.locations', compact('locations'));
	}



	public function transactions()
	{
		$transactions = Transaction::query()->paginate(self::PAGINATE_SIZE);

		return view('admins.transactions', compact('transactions'));
	}

	public function coupons()
	{
		$coupons = Coupon::query()->paginate(self::PAGINATE_SIZE);

		return view('admins.coupons', compact('coupons'));
	}

	public function users()
	{
		$users = User::query()->paginate(self::PAGINATE_SIZE);

		return view('admins.users', compact('users'));
	}
}
