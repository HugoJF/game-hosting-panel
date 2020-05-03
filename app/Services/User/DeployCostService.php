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

        $costs = $node->only(['cpu', 'memory', 'disk', 'databases']);

        $final = 0;

        foreach ($costs as $name => $cost) {
            $final += $cost * $config[ $name ] ?? 0;
        }

        return $final * $multipliers[ $billingPeriod ];
    }

    public function getDeployCost(Deploy $deploy, bool $real = false): int
    {
        $billable = $this->getBillablePeriod($deploy, $real);
        $costPerPeriod = $this->getCostPerPeriod($deploy->server->node, $deploy->billing_period, $deploy->config);
        return (int) round($billable * $costPerPeriod);
    }

    public function getBillablePeriod(Deploy $deploy, bool $real = false)
    {
        $period = $deploy->billing_period;
        $reference = $real ? 'terminated_at' : 'termination_requested_at';
        $differs = [
            'minutely' => 'diffInMinutes',
            'hourly'   => 'diffInHours',
            'daily'    => 'diffInDays',
            'weekly'   => 'diffInWeeks',
            'monthly'  => 'diffInMonths',
        ];

        $differ = $differs[ $period ];

        $ending = $deploy->$reference ?? now();

        return $deploy->created_at->$differ($ending) + 1;
    }
}
