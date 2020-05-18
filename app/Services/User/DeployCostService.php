<?php

namespace App\Services\User;

use App\Deploy;
use App\Node;

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

    public function getDeployCost(Deploy $deploy, bool $real = false): int
    {
        $billable = $this->getBillablePeriod($deploy, $real);

        return (int) round($billable * $deploy->cost_per_period);
    }

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

    public function getNextBillablePeriod(Deploy $deploy)
    {
        $billablePeriod = $this->getBillablePeriod($deploy, false);
        $adder = $this->getBillingPeriodAdd($deploy->billing_period);

        return $deploy->created_at->$adder($billablePeriod);
    }

    public function getBillablePeriod(Deploy $deploy, bool $real = false)
    {
        $billingPeriod = $deploy->billing_period;
        $reference = $real ? 'terminated_at' : 'termination_requested_at';
        $diff = $this->getBillingPeriodDiff($billingPeriod);

        $ending = $deploy->$reference ?? now();

        return $deploy->created_at->$diff($ending) + 1;
    }
}
