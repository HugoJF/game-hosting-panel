<?php

namespace Tests\Unit\Classes;

use App\Classes\OrderStoreRequest;
use Tests\TestCase;

class OrderStoreRequestTest extends TestCase
{
    public function test_order_resource_will_fill_nullable_properties()
    {
        $resource = new OrderStoreRequest([]);

        $fields = [
            'email',
            'webhook_url',
            'view_url',
            'avatar',
            'payer_steam_id',
            'payer_tradelink',
            'product_name_singular',
            'product_name_plural',
        ];

        foreach ($fields as $field) {
            $this->assertNull($resource->$field);
        }
    }

    public function test_order_resource_will_be_filled_correctly()
    {

        $data = [
            'reason'            => 'My reason',
            'return_url'        => 'https://google.com/',
            'cancel_url'        => 'https://youtube.com/',
            'preset_amount'     => 30,
            'preset_units'      => 50,
            'unit_price'        => 1,
            'unit_price_limit'  => 2,
            'discount_per_unit' => 0.1,
            'min_units'         => 100,
            'max_units'         => 1000,
        ];
        $resource = new OrderStoreRequest($data);

        foreach ($data as $field => $value) {
            $this->assertEquals($value, $resource->$field);
        }
    }
}
