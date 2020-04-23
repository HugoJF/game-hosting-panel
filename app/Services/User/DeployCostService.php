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
        // TODO: this is temporary for testing reasons
        $costs = [
            'minutely' => 100,
            'hourly'   => 200,
            'daily'    => 300,
            'weekly'   => 400,
            'monthly'  => 500,
        ];

        return $costs[ $billingPeriod ];
    }

    public function getDeployCost(Deploy $deploy, bool $real = false)
    {
        $billable = $this->getBillablePeriod($deploy, $real);

        return $billable * $this->getCostPerPeriod($deploy->server->node, $deploy->billing_period, []);
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
