<?php

namespace App\Classes;

class OrderResource extends Resource
{
    public string $id;
    public string $reason;
    public string $return_url;
    public string $cancel_url;
    public string $product_name_singular;
    public string $product_name_plural;
    public ?string $avatar;
    public ?string $payer_steam_id;
    public ?string $payer_tradelink;
    public int $preset_amount;
    public int $paid_amount;
    public int $unit_price;
    public int $unit_price_limit;
    public float $discount_per_unit;
    public int $min_units;
    public int $max_units;
    public int $recheck_attempts;
    public string $orderable_type;
    public int $orderable_id;
    public string $created_at;
    public string $updated_at;
    public ?string $webhook_url;
    public int $webhook_attempts;
    public ?string $webhook_attempted_at;
    public ?string $webhooked_at;
    public ?string $view_url;
    public ?string $email;
    public ?int $preset_units;
    public ?string $pre_approved_at;
    public ?int $units;
    public ?int $paid_units;
    public bool $paid;
    public ?string $type;
    public string $init_point;
    public ?array $orderable;
}
