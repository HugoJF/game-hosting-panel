<?php

namespace App\Services\User;

use App\Deploy;
use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidBillingPeriodException;
use App\Exceptions\InvalidPeriodCostException;
use App\Exceptions\TooManyServersException;
use App\Node;
use App\Server;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class UserPreChecks
{
    protected DeployCostService $costService;

    public function __construct(DeployCostService $costService)
    {
        $this->costService = $costService;
    }

    /**
     * @param User   $user
     * @param Node   $node
     * @param string $billingPeriod
     * @param array  $config
     *
     * @throws InsufficientBalanceException
     * @throws InvalidBillingPeriodException
     * @throws InvalidPeriodCostException
     */
    public function handle(User $user, Node $node, string $billingPeriod, array $config): void
    {
        if (!config("ghp.billing-periods.$billingPeriod")) {
            throw new InvalidBillingPeriodException($billingPeriod);
        }

        if (($costPerPeriod = $this->costService->getCostPerPeriod($node, $billingPeriod, $config)) <= 0) {
            throw new InvalidPeriodCostException;
        }

        if (!$user->hasBalance($costPerPeriod)) {
            throw new InsufficientBalanceException;
        }
    }
}
