<?php

namespace App\Services\User;

use App\Exceptions\ServerNotInstalledException;
use App\Server;
use App\Services\ServerService;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Resource;

class ServerBuildConfigService
{
    /**
     * @var Pterodactyl
     */
    protected Pterodactyl $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    /**
     * @param Server $server
     * @param array  $config
     *
     * @return array
     */
    public function handle(Server $server, array $config): array
    {
        $newLimits = $this->getServerLimits($server, $config);
        $details = $this->pterodactyl->server($server->panel_id);
        $defaults = config('pterodactyl.server-deployment-defaults');

        return [
            'limits'         => array_merge($details->limits, $newLimits, $defaults['limits']),
            'feature_limits' => $details->featureLimits,
            'allocation'     => $details->allocation,
            'oom_disabled'   => true,
        ];
    }

    private function getServerLimits(Server $server, array $config): array
    {
        // TODO: normalize this using $node information instead of being hardcoded
        $cpu = $config['cpu'];
        $nodePerformance = 2400;

        return array_merge($config, [
            'cpu' => $cpu / $nodePerformance * 100,
        ]);
    }
}
