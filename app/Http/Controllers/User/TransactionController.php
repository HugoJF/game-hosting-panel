<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Server;
use App\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function server(Server $server)
    {
        $deploys = $server->deploys()->get(['transaction_id']);

        $transactions = Transaction::query()->whereIn('id', $deploys)->paginate(15);

        return view('transactions.index', compact('transactions'));
    }
}
