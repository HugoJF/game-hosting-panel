<?php

namespace Tests\Unit\Service;

use App\Coupon;
use App\Services\CouponService;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CouponServiceTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    protected CouponService $service;
    protected User $user;
    protected int $max_uses;
    protected array $create;
    protected array $update;
    protected array $extra;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(CouponService::class);
        $this->max_uses = random_int(1, 10);
        $this->create = [
            'code'     => 'NICE',
            'value'    => 20,
            'max_uses' => 5,
        ];
        $this->update = [
            'code'     => '15OFF',
            'value'    => 30,
            'max_uses' => 10,
        ];
    }

    public function test_store_will_fill_and_persist(): void
    {
        $this->service->store($this->create);

        $this->assertDatabaseHas('coupons', $this->create);
    }

    public function test_update_will_fill_and_persist(): void
    {
        $key = factory(Coupon::class)->create($this->create);

        $this->service->update($key, $this->update);

        $this->assertDatabaseHas('coupons', $this->update);
    }
}
