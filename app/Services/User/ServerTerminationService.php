<?php

namespace App\Services\User;

use App\Classes\PterodactylClient;
use App\Deploy;
use App\Server;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Resource;

class ServerTerminationService
{
    protected Pterodactyl $pterodactyl;
    protected PterodactylClient $pterodacylClient;

    public function __construct(Pterodactyl $pterodactyl, PterodactylClient $pterodactylClient)
    {
        $this->pterodactyl = $pterodactyl;
        $this->pterodacylClient = $pterodactylClient;
    }

    /**
     * @param Server $server
     *
     * @return bool
     * @throws Exception
     */
    public function handle(Server $server)
    {
        $defaults = config('pterodactyl.server-termination-defaults');

        $details = $this->pterodactyl->server($server->panel_id);

        $buildConfig = [
            'limits'         => $details->limits,
            'feature_limits' => $details->featureLimits,
            'allocation'     => $details->allocation,
            'oom_disabled'   => true,
        ];

        $appServer = $this->pterodactyl->updateServerBuild($server->panel_id, array_merge($buildConfig, $defaults));

        $clientServer = $this->pterodacylClient->getServer($appServer->identifier);

        $clientServer->power('kill');

        /** @var Deploy $deploy */
        $deploy = $server->getDeploy();

        $deploy->terminated_at = now();
        $deploy->save();

        return $appServer instanceof Resource;
    }
}
