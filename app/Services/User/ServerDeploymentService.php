<?php

namespace App\Services\User;

use App\Exceptions\ServerNotInstalledException;
use App\Notifications\ServerDeployed;
use App\Server;
use App\Services\ServerService;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Resource;
use Throwable;

class ServerDeploymentService
{
    protected ServerService $serverService;
    protected ServerDeployConfigService $configService;
    protected ServerStartupConfigService $startupConfigService;
    protected Pterodactyl $pterodactyl;
    protected DeployCreationService $deployCreation;

    public function __construct(
        ServerService $serverService,
        ServerDeployConfigService $buildConfigService,
        ServerStartupConfigService $startupConfigService,
        Pterodactyl $pterodactyl,
        DeployCreationService $deployCreation
    ) {
        $this->serverService = $serverService;
        $this->configService = $buildConfigService;
        $this->startupConfigService = $startupConfigService;
        $this->pterodactyl = $pterodactyl;
        $this->deployCreation = $deployCreation;
    }

    /**
     * Deploys server by creating a Deploy model and updating server build config.
     *
     * @param Server $server
     * @param string $billingPeriod
     * @param array  $config
     *
     * @param array  $form
     *
     * @return bool
     * @throws ServerNotInstalledException
     * @throws Throwable
     */
    public function handle(Server $server, string $billingPeriod, array $config, array $form): bool
    {
        if (!$this->serverService->isInstalled($server)) {
            throw new ServerNotInstalledException;
        }

        // Update server build config
        $serverConfig = $this->configService->handle($server, $config);
        $serverResource = $this->pterodactyl->updateServerBuild($server->panel_id, $serverConfig);

        // Update server startup
        if ($server->form) {
            $startup = $this->startupConfigService->handle($server, $form);

            if ($startup !== null) {
                $this->pterodactyl->updateServerStartup($server->panel_id, $startup);
            }
        }

        $this->deployCreation->handle($server, $billingPeriod, $config, $form);

        $server->user->notify(new ServerDeployed($server));

        return $serverResource instanceof Resource;
    }
}
