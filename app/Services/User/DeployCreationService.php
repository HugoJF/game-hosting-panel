<?php

namespace App\Services\User;

use App\Deploy;
use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidBillingPeriodException;
use App\Server;
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
        if (!in_array($billingPeriod, config('ghp.billing-periods'))) {
            throw new InvalidBillingPeriodException($billingPeriod);
        }

        $costPerPeriod = $this->costService->getCostPerPeriod($server->node, $billingPeriod, $config);

        if (!$server->user->hasBalance($costPerPeriod)) {
            throw new InsufficientBalanceException;
        }

        try {
            DB::beginTransaction();

            $deploy = new Deploy();
            $deploy->forceFill([
                'billing_period'  => $billingPeriod,
                'cost_per_period' => $costPerPeriod, // TODO: actually compute this
                'cpu'             => $config['cpu'],
                'ram'             => $config['ram'],
                'disk'            => $config['storage'],
                'io'              => 500,
                'databases'       => $config['databases'],
                'server_id'       => $server->id,
            ])->save();

            DB::commit();

            return $deploy;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
