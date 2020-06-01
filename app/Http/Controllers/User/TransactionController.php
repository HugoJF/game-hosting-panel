<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
	public function index()
	{
		$transactions = auth()->user()->transactions()->latest()->paginate(10);

		return view('transactions.index', compact('transactions'));
	}
}
