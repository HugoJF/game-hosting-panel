<?php

namespace App\Observers;

use App\Classes\PaymentSystem;
use App\Order;
use App\Transaction;

class OrderObserver
{
	public function created(Order $order)
	{
		$transaction = Transaction::make();

		$transaction->value = 0;
		$transaction->user()->associate($order->user);
		$transaction->reason()->associate($order);

		$transaction->save();
	}

	public function retrieved(Order $order)
	{
		$ps = app(PaymentSystem::class);

		$data = $ps->getOrder($order->reference);

		if ($data->status === 200) {
			$order->paid = $data->content->paid;

			$order->save();
		}
	}

	public function saving(Order $order)
	{
		if (!$order->getOriginal('paid') && $order->paid)
			$order->firePaid();
	}

	public function paid(Order $order)
	{
		if(!$order->transaction) return;
		$order->transaction->value = $order->value;
		$order->transaction->save();
	}
}
