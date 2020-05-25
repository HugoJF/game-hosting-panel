<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
	public function index()
	{
		$orders = Auth::user()->orders()->latest()->get();

		return view('orders.index', compact('orders'));
	}

	public function create()
	{
		return view('orders.create');
	}

	public function store(OrderService $service, $amount)
	{
		if (!$service->isValidAmount($amount)) {
			flash()->error('Invalid amount');

			return redirect()->route('orders.create');
		}

		$res = $service->storePayment($amount);

		$order = $service->storeOrder($res, $amount);

		return redirect($order->init_point);
	}
}
