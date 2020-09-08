<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 12:48 AM
 */

namespace App\Services;

use App\Deploy;
use App\Exceptions\MultipleLiveDeploys;
use App\Server;
use App\Services\User\DeployTerminationService;
use HCGCloud\Pterodactyl\Pterodactyl;

class ServerService
{
    protected Pterodactyl $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    /**
     * Checks if server has finished game installation
     *
     * @param Server $server
     *
     * @return bool
     */
    public function isInstalled(Server $server): bool
    {
        $resource = $this->pterodactyl->server($server->panel_id);

        // Waiting installation if container is NOT installed
        return $resource->container['installed'];
    }

    /**
     * @param Server $server
     *
     * @return Deploy|null
     * @throws MultipleLiveDeploys
     */
    public function getCurrentDeploy(Server $server): ?Deploy
    {
        $server->loadMissing('deploys');
        $deploys = $server->deploys->where('terminated_at', null);

        if ($deploys->count() > 1) {
            throw new MultipleLiveDeploys;
        }

        return $deploys->first();
    }

    /**
     * @param Server $server
     * @param string $reason
     */
    public function terminateAllDeploys(Server $server, string $reason): void
    {
        /** @var DeployTerminationService $deployTermination */
        $deployTermination = app(DeployTerminationService::class);

        $server->loadMissing('deploys');
        $deploys = $server->deploys->where('terminated_at', null);

        foreach ($deploys as $deploy) {
            $deployTermination->terminateDeploy($deploy, $reason);
        }
    }
}
