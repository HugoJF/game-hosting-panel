<?php

namespace App\Services\User;

use App\Deploy;
use App\Exceptions\InvalidBillingPeriodException;
use App\Server;
use Exception;
use Illuminate\Support\Facades\DB;

class DeployCreationService
{
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

        try {
            DB::beginTransaction();

            $deploy = new Deploy();
            $deploy->forceFill([
                'cpu'            => $config['cpu'],
                'ram'            => $config['ram'],
                'disk'           => $config['storage'],
                'io'             => 500,
                'databases'      => $config['databases'],
                'billing_period' => $billingPeriod,
                'server_id'      => $server->id,
            ])->save();

            DB::commit();

            return $deploy;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
