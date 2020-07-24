<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 2:07 AM
 */

namespace App\Services\Forms;

use App\Coupon;
use App\Forms\CouponForm;

class CouponForms extends ServiceForm
{
	public function create(): \Kris\LaravelFormBuilder\Form
    {
		return $this->formBuilder->create(CouponForm::class, [
			'method' => 'POST',
			'url'    => route('coupons.store'),
		]);
	}

	public function edit(Coupon $coupon): \Kris\LaravelFormBuilder\Form
    {
		return $this->formBuilder->create(CouponForm::class, [
			'method' => 'PATCH',
			'url'    => route('coupons.update', $coupon),
			'model'  => $coupon,
		]);
	}
}
