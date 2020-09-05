<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/17/2019
 * Time: 9:08 PM
 */

namespace App\Services;

use App\Classes\OrderResource;
use App\Classes\OrderStoreRequest;
use App\Classes\PaymentSystem;
use App\Order;

class OrderService
{
    /**
     * Checks if Order amount is valid.
     *
     * @param $amount
     *
     * @return bool
     */
    public function isValidAmount($amount): bool
    {
        $amounts = config('orders.amounts');

        return in_array($amount, $amounts);
    }

    /**
     * Create new order from PaymentAPI and stores new Order.
     *
     * @param $amount
     *
     * @return mixed
     */
    public function storePayment($amount)
    {
        $order = new OrderStoreRequest;
        $formattedAmount = number_format($amount, 2);

        $order->reason = "R$ $formattedAmount | Host de_nerdTV";
        $order->return_url = route('orders.index');
        $order->cancel_url = route('orders.index');
        $order->preset_units = $amount * 100;
        $order->preset_amount = $amount * 100;
        $order->product_name_singular = 'real';
        $order->product_name_plural = 'reais';

        $order->unit_price = 1;
        $order->unit_price_limit = 1;
        $order->discount_per_unit = 0;
        $order->min_units = 100;
        $order->max_units = 10000;

        return app(PaymentSystem::class)->createOrder((array) $order);
    }

    /**
     * Stores new Order.
     *
     * @param $apiResponse
     * @param $amount
     *
     * @return Order
     */
    public function storeOrder($apiResponse, $amount): Order
    {
        $response = new OrderResource($apiResponse);

        $order = new Order;

        $order->reference = $response->id;
        $order->value = $amount * 100;
        $order->init_point = $response->init_point;
        $order->paid = false;

        $order->user()->associate(auth()->user());

        $order->save();

        return $order;
    }
}
