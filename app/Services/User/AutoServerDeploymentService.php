<?php

namespace App\Services\User;

use App\Exceptions\InsufficientBalanceException;
use App\Exceptions\InvalidBillingPeriodException;
use App\Exceptions\InvalidPeriodCostException;
use App\Exceptions\TooManyServersException;
use App\Jobs\AsyncServerDeployment;
use App\Node;
use App\Server;
use App\Services\ServerService;
use App\User;
use Exception;
use Throwable;

class AutoServerDeploymentService
{
    protected ServerService $serverService;
    protected ServerDeploymentService $deploymentService;
    protected DeployCreationService $deployCreation;
    protected DeployCostService $costService;

    public function __construct(
        ServerService $serverService,
        ServerDeploymentService $deploymentService,
        DeployCreationService $deployCreation,
        DeployCostService $costService
    )
    {
        $this->serverService = $serverService;
        $this->deploymentService = $deploymentService;
        $this->deployCreation = $deployCreation;
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
     * @throws InsufficientBalanceException
     * @throws InvalidPeriodCostException
     * @throws TooManyServersException
     * @throws InvalidBillingPeriodException
     * @throws Throwable
     */
    public function handle(Server $server, string $billingPeriod, array $config): void
    {
        $this->deployCreation->preChecks($server->user, $server->node, $billingPeriod, $config);

        if ($this->serverService->isInstalled($server)) {
            $this->deploymentService->handle($server, $billingPeriod, $config);
        } else {
            dispatch(new AsyncServerDeployment($server, $billingPeriod, $config));
        }
    }
}
