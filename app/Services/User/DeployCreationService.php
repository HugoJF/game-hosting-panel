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
use Illuminate\Support\Facades\DB;
use Throwable;

class DeployCreationService
{
    protected DeployCostService $costService;
    protected UserPreChecks $preChecks;

    public function __construct(DeployCostService $costService, UserPreChecks $preChecks)
    {
        $this->costService = $costService;
        $this->preChecks = $preChecks;
    }

    /**
     * Creates a new Deploy model inside a migration.
     *
     * @param Server $server
     * @param string $billingPeriod
     * @param array  $config
     * @param array  $form
     *
     * @return Deploy
     * @throws Throwable
     */
    public function handle(
        Server $server,
        string $billingPeriod,
        array $config,
        array $form
    ): Deploy {
        return DB::transaction(fn() => $this->create($server, $billingPeriod, $config, $form));
    }

    protected function create(
        Server $server,
        string $billingPeriod,
        array $config,
        array $form
    ): Deploy {
        $this->preChecks($server->user, $server->node, $billingPeriod, $config);

        $costPerPeriod = $this->costService->getCostPerPeriod($server->node, $billingPeriod, $config);

        return tap(new Deploy, fn(Deploy $deploy) => $deploy->forceFill([
            'billing_period'  => $billingPeriod,
            'cost_per_period' => $costPerPeriod,
            'cpu'             => $config['cpu'],
            'memory'          => $config['memory'],
            'disk'            => $config['disk'],
            'databases'       => $config['databases'],
            'form'            => json_encode($form, JSON_THROW_ON_ERROR),
            'server_id'       => $server->id,
            'io'              => 500,
        ])->save());
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
    public function preChecks(User $user, Node $node, string $billingPeriod, array $config): void
    {
        $this->preChecks->handle($user, $node, $billingPeriod, $config);

        if ($user->servers()->count() > $user->server_limit) {
            throw new TooManyServersException;
        }
    }
}
