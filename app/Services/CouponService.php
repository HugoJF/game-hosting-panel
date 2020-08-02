<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 2:10 AM
 */

namespace App\Services;

use App\Coupon;
use App\Events\CouponUsed;
use App\Exceptions\CouponAlreadyUsedException;
use App\Exceptions\CouponMaxUsesReachedException;
use App\Transaction;
use App\User;
use DB;
use Exception;

class CouponService
{
    /**
     * Stores new Coupon.
     *
     * @param array $form
     * @param array $data
     *
     * @return Coupon
     */
    public function store(array $form, array $data = []): Coupon
    {
        $coupon = new Coupon;

        $coupon->fill($form);
        $coupon->forceFill($data);

        return save($coupon);
    }

    /**
     * Updates Coupon information.
     *
     * @param Coupon $coupon
     * @param array  $data
     *
     * @return Coupon
     */
    public function update(Coupon $coupon, array $data): Coupon
    {
        $coupon->fill($data);

        return save($coupon);
    }

    /**
     * Checks if user can use Coupon and stores new Transaction.
     *
     * @param User   $user
     * @param Coupon $coupon
     *
     * @return Transaction
     * @throws Exception
     */
    public function use(User $user, Coupon $coupon): Transaction
    {
        if ($coupon->uses >= $coupon->max_uses) {
            throw new CouponMaxUsesReachedException;
        }

        if ($user->coupons()->where('coupons.id', $coupon->id)->exists()) {
            throw new CouponAlreadyUsedException;
        }

        return DB::transaction(fn () => $this->processCoupon($user, $coupon));
    }

    protected function processCoupon(User $user, Coupon $coupon)
    {
        $transaction = $this->generateTransaction($user, $coupon);

        $coupon->users()->attach($user);

        event(new CouponUsed($coupon, $user));

        return $transaction;
    }

    protected function generateTransaction(User $user, Coupon $coupon)
    {
        $transaction = new Transaction;

        $transaction->value = $coupon->value;
        $transaction->user()->associate($user);

        return tap($transaction)->save();
    }
}
