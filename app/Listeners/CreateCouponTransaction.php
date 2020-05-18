<?php

namespace App\Listeners;

use App\Coupon;
use App\Events\CouponUsed;
use App\Transaction;
use App\User;

class CreateCouponTransaction
{
    /**
     * Create the event listener.
     *
     * @param User $user
     * @param Coupon $coupon
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CouponUsed  $event
     * @return void
     */
    public function handle(CouponUsed $event)
    {
        $transaction = Transaction::make();

        $transaction->value = $event->coupon->value;
        $transaction->user()->associate($event->user);
        $transaction->reason()->associate($event->coupon);

        $transaction->save();
    }
}
