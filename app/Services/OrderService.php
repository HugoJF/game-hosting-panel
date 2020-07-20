<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/17/2019
 * Time: 9:08 PM
 */

namespace App\Services;

use App\Classes\PaymentSystem;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
	/**
	 * Checks if Order amount is valid.
	 *
	 * @param $amount
	 *
	 * @return bool
	 */
	public function isValidAmount($amount)
	{
		$amounts = config('orders.amounts');

		return in_array($amount, $amounts);
	}

	/**
	 * Create new order from PaymentAPI and stores new Order.
	 * @param $amount
	 *
	 * @return mixed
	 */
	public function storePayment($amount)
	{
		$formattedAmount = number_format($amount, 2);

		$details['reason'] = "R$ $formattedAmount dias nos servidores de_nerdTV";
		$details['return_url'] = route('orders.index');
		$details['cancel_url'] = route('orders.index');
		$details['preset_amount'] = $amount * 100;
		$details['product_name_singular'] = 'real';
		$details['product_name_plural'] = 'reais';

		$details['avatar'] = '';
		$details['payer_steam_id'] = '';
		$details['payer_tradelink'] = '';

		$details['unit_price'] = 26;
		$details['unit_price_limit'] = 26;
		$details['discount_per_unit'] = 0;
		$details['min_units'] = 10;
		$details['max_units'] = 100;

		$paymentSystem = app(PaymentSystem::class);

        return $paymentSystem->createOrder($details);
	}

	/**
	 * Stores new Order.
	 *
	 * @param $apiResponse
	 * @param $amount
	 *
	 * @return Order
	 */
	public function storeOrder($apiResponse, $amount)
	{
		$order = Order::make();

		$order->reference = $apiResponse->id;
		$order->value = $amount * 100;
		$order->init_point = $apiResponse->init_point;
		$order->paid = false;

		$order->user()->associate(auth()->user());

		$order->save();

		return $order;
	}
}
