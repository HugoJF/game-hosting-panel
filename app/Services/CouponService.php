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
use App\Transaction;
use App\User;
use DB;
use Exception;

class CouponService
{
    /**
     * Stores new Coupon.
     *
     * @param array $data
     *
     * @return Coupon
     */
    public function storeCoupon(array $data)
    {
        $coupon = Coupon::make();

        $coupon->fill($data);

        $coupon->save();

        return $coupon;
    }

    /**
     * Updates Coupon information.
     *
     * @param Coupon $coupon
     * @param array  $data
     *
     * @return Coupon
     */
    public function updateCoupon(Coupon $coupon, array $data)
    {
        $coupon->fill($data);

        $coupon->save();

        return $coupon;
    }

    /**
     * Checks if user can use Coupon and stores new Transaction.
     *
     * @param User   $user
     * @param Coupon $coupon
     *
     * @return Transaction|null
     * @throws Exception
     */
    public function use(User $user, Coupon $coupon)
    {
        if ($coupon->uses >= $coupon->max_uses) {
            flash()->error('Coupon max uses reached!');

            return null;
        }

        if ($user->coupons()->where('coupons.id', $coupon->id)->exists()) {
            flash()->error('Coupons can only be used one time!');

            return null;
        }

        DB::beginTransaction();

        try {
            $transaction = $this->generateTransaction($user, $coupon);

            $coupon->users()->attach($user);

            event(new CouponUsed($coupon, $user));

            DB::commit();

            return $transaction;
        } catch (Exception $e) {
            report($e);
            DB::rollBack();

            return null;
        }
    }

    protected function generateTransaction(User $user, Coupon $coupon)
    {
        $transaction = new Transaction;

        $transaction->value = $coupon->value;
        $transaction->user()->associate($user);

        return tap($transaction)->save();
    }
}
