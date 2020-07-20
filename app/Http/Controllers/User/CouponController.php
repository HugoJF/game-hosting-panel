<?php

namespace App\Http\Controllers\User;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Services\CouponService;
use App\Services\Forms\CouponForms;
use App\Transaction;
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
        /** @var Transaction $transaction */
        if (!$transaction = $service->use(auth()->user(), $coupon)) {
            return back();
        }

        $value = number_format($transaction->value / 100, 2);
        flash()->success("Coupon successfully used! <strong>R$ $value</strong> were credited on transaction <strong>$transaction->id</strong>");

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
        $service->store($request->validated());

        flash()->success('Coupon created!');

        return redirect()->route('admins.coupons');
    }

    public function update(CouponService $service, CouponUpdateRequest $request, Coupon $coupon)
    {
        $service->update($coupon, $request->validated());

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
