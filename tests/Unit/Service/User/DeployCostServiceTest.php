<?php

namespace Tests\Unit\Service\User;

use App\Deploy;
use App\Node;
use App\Services\User\DeployCostService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeployCostServiceTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /**
     * @var DeployCostService
     */
    protected $service;

    /**
     * Test getBillablePeriod will correctly round periods to
     */
    public function test_get_billable_period_will_compute_minutely_correctly(): void
    {
        $test = function (
            string $billingPeriod,
            Carbon $createdAt,
            Carbon $terminationRequestAt,
            Carbon $terminatedAt,
            int $expectedClient,
            int $expectedReal
        ) {
            $deploy = factory(Deploy::class)->make([
                'billing_period'           => $billingPeriod,
                'created_at'               => $createdAt,
                'termination_requested_at' => $terminationRequestAt,
                'terminated_at'            => $terminatedAt,
            ]);

            if ($expectedReal) {
                $periodReal = $this->service->getBillablePeriod($deploy, true);
                $this->assertEquals($expectedReal, $periodReal);
            }

            if ($expectedClient) {
                $periodClient = $this->service->getBillablePeriod($deploy, false);
                $this->assertEquals($expectedClient, $periodClient);
            }
        };

        /**
         * Assert that a Deploy will always have a minimum billable period of 1.
         * Assert that anything below a full period will still be counted as only 1.
         */
        $test('minutely', now(), now(), now()->addSeconds(59), 1, 1);
        $test('hourly', now(), now(), now()->addMinutes(59), 1, 1);
        $test('daily', now(), now(), now()->addHours(23), 1, 1);
        $test('weekly', now(), now(), now()->addDays(6), 1, 1);
        $test('monthly', now(), now(), now()->addDays(30), 1, 1);

        /**
         * Assert that anything below a full period will still be counted as only 1.
         * Assert that exactly 1 period will be billed as 2 periods.
         */
        $test('minutely', now(), now()->addSeconds(59), now()->addSeconds(60), 1, 2);
        $test('hourly', now(), now()->addMinutes(59), now()->addMinutes(60), 1, 2);
        $test('daily', now(), now()->addHours(23), now()->addHours(24), 1, 2);
        $test('weekly', now(), now()->addDays(6), now()->addDays(7), 1, 2);
        $test('monthly', now(), now()->addDays(30), now()->addDays(31), 1, 2);

        /**
         * Assert that exactly 1 period will be billed as 2 periods.
         * Assert that 2 periods will be billed as 3 periods.
         */
        $test('minutely', now(), now()->addSeconds(60), now()->addSeconds(120), 2, 3);
        $test('hourly', now(), now()->addMinutes(60), now()->addMinutes(120), 2, 3);
        $test('daily', now(), now()->addHours(24), now()->addHours(48), 2, 3);
        $test('weekly', now(), now()->addDays(7), now()->addDays(14), 2, 3);
        $test('monthly', now(), now()->addDays(31), now()->addDays(62), 2, 3);
    }

    /**
     * Test getNextBillablePeriod can correctly calculate the date in which a new period will be billed.
     */
    public function test_get_next_billable_period()
    {
        $test = function (string $billingPeriod, Carbon $base, Carbon $next) {
            $deploy = factory(Deploy::class)->make([
                'billing_period' => $billingPeriod,
                'created_at'     => $base,
            ]);

            $nextPeriod = $this->service->getNextBillablePeriod($deploy);
            $this->assertEquals($next, $nextPeriod);
        };

        $test('minutely', $base = now()->subSeconds(30), $base->clone()->addMinutes(1));
        $test('minutely', $base = now()->subSeconds(90), $base->clone()->addMinutes(2));

        $test('hourly', $base = now()->subMinutes(30), $base->clone()->addHours(1));
        $test('hourly', $base = now()->subMinutes(90), $base->clone()->addHours(2));

        $test('daily', $base = now()->subHours(12), $base->clone()->addDays(1));
        $test('daily', $base = now()->subHours(36), $base->clone()->addDays(2));

        $test('weekly', $base = now()->subDays(1), $base->clone()->addWeeks(1));
        $test('weekly', $base = now()->subDays(7), $base->clone()->addWeeks(2));

        $test('monthly', $base = now()->subDays(15), $base->clone()->addMonths(1));
        $test('monthly', $base = now()->subDays(45), $base->clone()->addMonths(2));
    }

    public function test_deploy_cost_will_use_stored_period_cost()
    {
        // There is no need to use multiple periods, since they should be already tested and valid.
        $deploy = factory(Deploy::class)->make([
            'billing_period'           => 'hourly',
            'created_at'               => now()->subMinutes(70),
            'termination_requested_at' => now()->subMinutes(15),
            'terminated_at'            => now(),
            'cost_per_period'          => 100,
        ]);

        $clientCost = $this->service->getDeployCost($deploy, false);
        $realCost = $this->service->getDeployCost($deploy, true);

        $this->assertEquals(100, $clientCost);
        $this->assertEquals(200, $realCost);
    }

    public function test_cost_per_period_will_use_deploy_information()
    {
        $periods = ['minutely', 'hourly', 'daily', 'weekly', 'monthly'];
        /** @var Node $node */
        $node = factory(Node::class)->make([
            'cpu_cost'      => 0.2,
            'memory_cost'   => 2,
            'disk_cost'     => 0.05,
            'database_cost' => 500,
        ]);

        $multipliers = config('ghp.cost-multiplier');

        $config = [
            'cpu'       => 2000,
            'memory'    => 1000,
            'disk'      => 10000,
            'databases' => 5,
        ];

        collect($periods)->each(function ($period) use ($node, $config, $multipliers) {
            $expectedCpuCost = $config['cpu'] * $node->cpu_cost;
            $expectedMemoryCost = $config['memory'] * $node->memory_cost;
            $expectedDiskCost = $config['disk'] * $node->disk_cost;
            $expectedDatabaseCost = $config['databases'] * $node->database_cost;

            $total = $expectedCpuCost + $expectedMemoryCost + $expectedDiskCost + $expectedDatabaseCost;
            $expected = $total * $multipliers[ $period ];

            $cost = $this->service->getCostPerPeriod($node, $period, $config);

            $this->assertEquals($expected, $cost);
        });
    }

    protected function setUp(): void
    {
        parent::setUp();

        Carbon::setTestNow(Carbon::create(2020, 1, 1, 0, 0, 0));

        $this->service = app(DeployCostService::class);
    }
}
