<?php

namespace App\Classes;

class OrderStoreRequest extends Resource
{
    //'email' => 'email|nullable',
    public ?string $email;

    //'reason' => 'required',
    public string $reason;

    //'return_url' => 'required',
    public string $return_url;

    //'cancel_url' => 'required',
    public string $cancel_url;

    //'webhook_url' => 'nullable|string',
    public ?string $webhook_url;

    //'view_url' => 'nullable|string',
    public ?string $view_url;

    //'preset_amount' => 'required|numeric',
    public int $preset_amount;

    //'preset_units' => 'required|numeric',
    public int $preset_units;

    //'unit_price' => 'required|numeric',
    public int $unit_price;

    //'unit_price_limit' => 'required|numeric',
    public int $unit_price_limit;

    //'discount_per_unit' => 'required|numeric',
    public float $discount_per_unit;

    //'min_units' => 'required|numeric',
    public int $min_units;

    //'max_units' => 'required|numeric',
    public int $max_units;

    //'avatar' => 'string|nullable',
    public ?string $avatar;

    //'payer_steam_id' => 'string|nullable',
    public ?string $payer_steam_id;

    //'payer_tradelink' => 'string|nullable',
    public ?string $payer_tradelink;

    //'product_name_singular' => 'string|nullable',
    public ?string $product_name_singular;

    //'product_name_plural' => 'string|nullable',
    public ?string $product_name_plural;
}
