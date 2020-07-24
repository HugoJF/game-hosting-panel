<?php

namespace App\Services\User;

use App\Deploy;
use App\Node;
use Carbon\Carbon;

class DeployCostService
{
    /**
     * Calculates the cost of the smallest unit of time for a giving billing period.
     *
     * @param Node   $node
     * @param string $billingPeriod
     * @param array  $config
     *
     * @return mixed
     */
    public function getCostPerPeriod(Node $node, string $billingPeriod, array $config)
    {
        $multipliers = config('ghp.cost-multiplier');

        $params = [
            'cpu'       => 'cpu_cost',
            'memory'    => 'memory_cost',
            'disk'      => 'disk_cost',
            'databases' => 'database_cost',
        ];

        $final = 0;

        foreach ($params as $name => $costName) {
            $final += $node->$costName * $config[ $name ] ?? 0;
        }

        return $final * $multipliers[ $billingPeriod ];
    }

    /**
     * Calculates the cost of a deployment.
     *
     * If $real is true, calculates the duration based on when Deploy was actually terminated;
     * If $real is false, calculates the duration based on when Deploy was requested to be terminated.
     *
     * @param Deploy $deploy
     * @param bool   $real
     *
     * @return int
     */
    public function getDeployCost(Deploy $deploy, bool $real = false): int
    {
        $billable = $this->getBillablePeriod($deploy, $real);

        return (int) round($billable * $deploy->cost_per_period);
    }

    /**
     * Get difference function name to be used for billing period
     *
     * @param $billingPeriod
     *
     * @return mixed
     */
    public function getBillingPeriodDiff($billingPeriod)
    {
        $diffs = [
            'minutely' => 'diffInMinutes',
            'hourly'   => 'diffInHours',
            'daily'    => 'diffInDays',
            'weekly'   => 'diffInWeeks',
            'monthly'  => 'diffInMonths',
        ];

        return $diffs[ $billingPeriod ];
    }

    /**
     * Get addition function name to be used for billing period
     * @param $billingPeriod
     *
     * @return mixed
     */
    public function getBillingPeriodAdd($billingPeriod)
    {
        $adds = [
            'minutely' => 'addMinutes',
            'hourly'   => 'addHours',
            'daily'    => 'addDays',
            'weekly'   => 'addWeeks',
            'monthly'  => 'addMonths',
        ];

        return $adds[ $billingPeriod ];
    }

    /**
     * Returns when current period will end
     *
     * @param Deploy $deploy
     *
     * @return Carbon
     */
    public function getNextBillablePeriod(Deploy $deploy): Carbon
    {
        $billablePeriod = $this->getBillablePeriod($deploy, false);
        $adder = $this->getBillingPeriodAdd($deploy->billing_period);

        return $deploy->created_at->$adder($billablePeriod);
    }

    /**
     * Calculates how many periods the Deploy has used.
     *
     * If $real is true, calculates the duration based on when Deploy was actually terminated;
     * If $real is false, calculates the duration based on when Deploy was requested to be terminated.
     *
     * @param Deploy $deploy
     * @param bool   $real
     *
     * @return int
     */
    public function getBillablePeriod(Deploy $deploy, bool $real = false): int
    {
        $billingPeriod = $deploy->billing_period;
        $reference = $real ? 'terminated_at' : 'termination_requested_at';
        $diff = $this->getBillingPeriodDiff($billingPeriod);

        $ending = $deploy->$reference ?? now();

        return $deploy->created_at->$diff($ending) + 1;
    }
}
