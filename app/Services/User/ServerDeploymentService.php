<?php

namespace App\Services\User;

use App\Server;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;

class ServerDeploymentService
{
    /**
     * @var Pterodactyl
     */
    protected $pterodactyl;

    /**
     * @var DeployCreationService
     */
    protected $deployCreation;

    public function __construct(Pterodactyl $pterodactyl, DeployCreationService $deployCreation)
    {
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
     * @throws Exception
     */
    public function handle(Server $server, string $billingPeriod, array $config)
    {
        $this->deployCreation->handle($server, $billingPeriod, $config);

        $this->updateServerConfig($server, $config);
    }

    protected function updateServerConfig(Server $server, array $config)
    {
        $this->pterodactyl->updateServerBuild($server->panel_id, $config);
    }
}
