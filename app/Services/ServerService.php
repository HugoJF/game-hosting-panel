<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 12:48 AM
 */

namespace App\Services;

use App\Server;
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
    public function isInstalled(Server $server)
    {
        $resource = $this->pterodactyl->server($server->panel_id);

        // Waiting installation if container is NOT installed
        return $resource->container['installed'];
	}
}
