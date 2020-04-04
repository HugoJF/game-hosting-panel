<?php

namespace App\Http\Controllers\User;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Services\CouponService;
use App\Services\Forms\CouponForms;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
	public function index()
	{
		$coupons = Auth::user()->coupons;

		return view('coupons.index', compact('coupons'));
	}

	public function use(CouponService $service, Coupon $coupon)
	{
		if (!$service->use(Auth::user(), $coupon))
			return back();

		$amount = number_format($coupon->transaction->value / 100, 2);
		flash()->success("Coupon successfully used! <strong>R$ $amount</strong> were credited on transaction <strong>$coupon->transaction->id</strong>");

		return redirect()->route('transactions.index');
	}

	public function show(Coupon $coupon)
	{
		return view('coupons.show', compact('coupon'));
	}

	public function create(CouponForms $forms)
	{
		$form = $forms->create();

		return view('form', [
			'title'       => 'Creating new coupon',
			'form'        => $form,
			'submit_text' => 'Create',
		]);
	}

	public function edit(CouponForms $forms, Coupon $coupon)
	{
		$form = $forms->edit($coupon);

		return view('form', [
			'title'       => "Updating coupon {$coupon->id}",
			'form'        => $form,
			'submit_text' => 'Update',
		]);
	}

	public function store(CouponService $service, CouponStoreRequest $request)
	{
		$service->storeCoupon($request->validated());

		flash()->success('Coupon created!');

		return redirect()->route('admins.coupons');
	}

	public function update(CouponService $service, CouponUpdateRequest $request, Coupon $coupon)
	{
		$service->updateCoupon($coupon, $request->validated());

		flash()->success('Coupon updated!');

		return redirect()->route('admins.coupons');
	}

	public function destroy(Coupon $coupon)
	{
		$coupon->delete();

		flash()->success("Coupon $coupon->id deleted!");

		return back();
	}
}
