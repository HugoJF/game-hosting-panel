<?php

namespace Tests\Unit\Service;

use App\Coupon;
use App\Exceptions\CouponAlreadyUsedException;
use App\Exceptions\CouponMaxUsesReachedException;
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

    public function test_coupon_will_generate_transaction()
    {
        $coupon = factory(Coupon::class)->create([
            'value'    => 5000,
            'max_uses' => 1,
        ]);

        /** @var User $user */
        $user = factory(User::class)->create();

        $this->service->use($user, $coupon);

        $this->assertEquals(5000, $user->balance);
    }

    public function test_coupon_can_only_be_used_limited_times()
    {
        $coupon = factory(Coupon::class)->create([
            'value'    => 5000,
            'max_uses' => 1,
        ]);

        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->expectException(CouponMaxUsesReachedException::class);

        $this->service->use($user1, $coupon);
        $this->service->use($user2, $coupon);
    }

    public function test_coupons_can_only_be_used_once_per_user()
    {
        $coupon = factory(Coupon::class)->create([
            'value'    => 5000,
            'max_uses' => 2,
        ]);

        $user = factory(User::class)->create();

        $this->expectException(CouponAlreadyUsedException::class);

        $this->service->use($user, $coupon);
        $this->service->use($user, $coupon);
    }

}
