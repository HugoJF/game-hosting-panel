<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
	public function index()
	{
		$transactions = Auth::user()->transactions()->latest()->get();

		return view('transactions.index', compact('transactions'));
	}
}
