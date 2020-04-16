<?php

namespace App\Services\User;

use App\Server;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Resource;

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
     * @return bool
     * @throws Exception
     */
    public function handle(Server $server, string $billingPeriod, array $config)
    {
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
