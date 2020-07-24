<?php

namespace App\Services\User;

use App\Server;
use HCGCloud\Pterodactyl\Pterodactyl;

class ServerDeletionService
{
    protected Pterodactyl $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    public function handle(Server $server)
    {
        $this->pterodactyl->deleteServer($server->panel_id);

        $server->delete();
    }
}
