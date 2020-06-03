<?php

namespace App\Services\User;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidPeriodCostException;
use App\Exceptions\TooManyServersException;
use App\Jobs\AsyncServerDeployment;
use App\Node;
use App\Server;
use App\Services\ServerService;
use App\User;
use Exception;

class AutoServerDeploymentService
{
    /**
     * @var ServerService
     */
    protected $serverService;

    /**
     * @var ServerDeploymentService
     */
    protected $deploymentService;

    /**
     * @var DeployCostService
     */
    protected $costService;

    public function __construct(
        ServerService $serverService,
        ServerDeploymentService $deploymentService,
        DeployCostService $costService
    )
    {
        $this->serverService = $serverService;
        $this->deploymentService = $deploymentService;
        $this->costService = $costService;
    }

    /**
     * Checks if a server is already installed before deploying it.
     *
     * - If the server is already installed, then it will be immediately deployed.
     * - If server is not installed, then it will dispatch a job that will wait for it to finish before deploying it.
     *
     * @param Server $server
     * @param string $billingPeriod
     * @param array  $config
     *
     * @throws Exception
     */
    public function handle(Server $server, string $billingPeriod, array $config)
    {
        $this->preChecks($server->user, $server->node, $billingPeriod, $config);

        if ($this->serverService->isInstalled($server)) {
            $this->deploymentService->handle($server, $billingPeriod, $config);
        } else {
            dispatch(new AsyncServerDeployment($server, $billingPeriod, $config));
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
     */
    public function preChecks(User $user, Node $node, string $billingPeriod, array $config)
    {
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
