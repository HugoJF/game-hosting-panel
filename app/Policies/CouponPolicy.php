<?php

namespace App\Policies;

use App\Coupon;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy extends BasePolicy
{
	public function index(User $user)
	{
		return false;
	}

	public function view(User $user, Coupon $coupon)
	{
		return true;
	}

	public function use(User $user, Coupon $coupon)
	{
		return true;
	}

	public function create(User $user)
	{
		return false;
	}

	public function update(User $user, Coupon $coupon)
	{
		return false;
	}

	public function delete(User $user, Coupon $coupon)
	{
		return false;
	}
}
