<?php

namespace App\Observers;

use App\Classes\PaymentSystem;
use App\Order;
use App\Transaction;
use Exception;

class OrderObserver
{
    public function created(Order $order): void
    {
        $transaction = Transaction::make();

        $transaction->value = 0;
        $transaction->user()->associate($order->user);

        $transaction->save();

        $order->transaction()->associate($transaction);
        $order->save();
    }

    public function retrieved(Order $order): void
    {
        $ps = app(PaymentSystem::class);

        $data = $ps->getOrder($order->reference);

        $order->paid = $data->paid;

        $order->save();
    }

    public function saving(Order $order): void
    {
        if ($order->paid && !$order->getOriginal('paid')) {
            $order->firePaid();
        }
    }

    public function paid(Order $order): void
    {
        if (!$order->transaction) {
            throw new Exception('Order was paid but could not find transaction to update!');
        }

        $order->transaction->value = $order->value;
        $order->transaction->save();
    }
}
