<?php

namespace App\Policies;

use App\Coupon;
use App\User;

class CouponPolicy extends BasePolicy
{
	public function index(User $user): bool
    {
		return false;
	}

	public function view(User $user, Coupon $coupon): bool
    {
		return true;
	}

	public function use(User $user, Coupon $coupon): bool
    {
		return true;
	}

	public function create(User $user): bool
    {
		return false;
	}

	public function update(User $user, Coupon $coupon): bool
    {
		return false;
	}

	public function delete(User $user, Coupon $coupon): bool
    {
		return false;
	}
}
