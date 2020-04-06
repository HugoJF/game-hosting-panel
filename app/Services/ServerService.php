<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 12:48 AM
 */

namespace App\Services;

use App\Game;
use App\Location;
use App\Server;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class ServerService
{
    /**
     * @var Pterodactyl
     */
    protected $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    /**
     * Checks if server has finished game installation
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
