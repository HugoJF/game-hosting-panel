<?php

namespace App\Services\User;

use App\Exceptions\ServerNotInstalledException;
use App\Server;
use App\Services\ServerService;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Resource;

class ServerDeploymentService
{
    /**
     * @var ServerService
     */
    protected $serverService;

    /**
     * @var Pterodactyl
     */
    protected $pterodactyl;

    /**
     * @var DeployCreationService
     */
    protected $deployCreation;

    public function __construct(ServerService $serverService,Pterodactyl $pterodactyl, DeployCreationService $deployCreation)
    {
        $this->pterodactyl = $pterodactyl;
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
     */
    public function handle(Server $server, string $billingPeriod, array $config)
    {
        if (!$this->serverService->isInstalled($server)) {
            throw new ServerNotInstalledException;
        }

        $details = $this->pterodactyl->server($server->panel_id);

        $buildConfig = [
            'limits'         => array_merge($details->limits, $config),
            'feature_limits' => $details->featureLimits,
            'allocation'     => $details->allocation,
            'oom_disabled'   => true,
        ];

        $s = $this->pterodactyl->updateServerBuild($server->panel_id, $buildConfig);

        $this->deployCreation->handle($server, $billingPeriod, $config);

        return $s instanceof Resource;
    }
}
