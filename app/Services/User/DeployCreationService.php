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

class DeployCreationService
{
    /**
     * @var DeployCostService
     */
    protected $costService;

    public function __construct(DeployCostService $costService)
    {
        $this->costService = $costService;
    }

    /**
     * Creates a new Deploy model inside a migration.
     *
     * @param Server $server
     * @param string $billingPeriod
     * @param array  $config
     *
     * @return Deploy
     * @throws Exception
     */
    public function handle(Server $server, string $billingPeriod, array $config): Deploy
    {
        $this->preChecks($server->user, $server->node, $billingPeriod, $config);

        $costPerPeriod = $this->costService->getCostPerPeriod($server->node, $billingPeriod, $config);

        try {
            DB::beginTransaction();

            $deploy = new Deploy();
            $deploy->forceFill([
                'billing_period'  => $billingPeriod,
                'cost_per_period' => $costPerPeriod,
                'cpu'             => $config['cpu'],
                'memory'          => $config['memory'],
                'disk'            => $config['disk'],
                'databases'       => $config['databases'],
                'server_id'       => $server->id,
                'io'              => 500,
            ])->save();

            DB::commit();

            return $deploy;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @param User   $user
     * @param Node   $node
     * @param string $billingPeriod
     * @param array  $config
     *
     * @throws InsufficientBalanceException
     * @throws TooManyServersException
     * @throws InvalidPeriodCostException
     * @throws InvalidBillingPeriodException
     */
    public function preChecks(User $user, Node $node, string $billingPeriod, array $config)
    {
        if (!config("ghp.billing-periods.$billingPeriod")) {
            throw new InvalidBillingPeriodException($billingPeriod);
        }

        if ($costPerPeriod = $this->costService->getCostPerPeriod($node, $billingPeriod, $config) <= 0) {
            throw new InvalidPeriodCostException;
        }

        if (!$user->hasBalance($costPerPeriod)) {
            throw new InsufficientBalanceException;
        }

        if ($user->servers()->count() >= $user->server_limit) {
            throw new TooManyServersException;
        }
    }
}
