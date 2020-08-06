<?php

namespace App\Services\User;

use App\Exceptions\ServerNotInstalledException;
use App\Notifications\ServerDeployed;
use App\Server;
use App\Services\ServerService;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Resource;
use Throwable;

class ServerDeploymentService
{
    protected ServerService $serverService;
    protected ServerDeployConfigService $configService;
    protected Pterodactyl $pterodactyl;
    protected DeployCreationService $deployCreation;

    public function __construct(
        ServerService $serverService,
        ServerDeployConfigService $buildConfigService,
        Pterodactyl $pterodactyl,
        DeployCreationService $deployCreation
    ) {
        $this->pterodactyl = $pterodactyl;
        $this->configService = $buildConfigService;
        $this->deployCreation = $deployCreation;
        $this->serverService = $serverService;
    }

    /**
     * Deploys server by creating a Deploy model and updating server build config.
     *
     * @param Server $server
     * @param string $billingPeriod
     * @param array  $config
     *
     * @return bool
     * @throws Exception
     * @throws Throwable
     */
    public function handle(Server $server, string $billingPeriod, array $config): bool
    {
        if (!$this->serverService->isInstalled($server)) {
            throw new ServerNotInstalledException;
        }

        $serverConfig = $this->configService->handle($server, $config);

        $s = $this->pterodactyl->updateServerBuild($server->panel_id, $serverConfig);

        $this->deployCreation->handle($server, $billingPeriod, $config);

        $server->user->notify(new ServerDeployed($server));

        return $s instanceof Resource;
    }
}
