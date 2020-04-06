<?php

namespace App\Services\User;

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
            'minutely' => 10,
            'hourly'   => 20,
            'daily'    => 30,
            'weekly'   => 40,
            'monthly'  => 50,
        ];

        return $costs[ $billingPeriod ];
    }
}
