<?php

namespace App\Services\User;

use App\Server;
use App\Services\ServerService;
use HCGCloud\Pterodactyl\Pterodactyl;

class ServerDeletionService
{
    protected Pterodactyl $pterodactyl;
    /**
     * @var ServerService
     */
    protected ServerService $service;

    public function __construct(Pterodactyl $pterodactyl, ServerService $service)
    {
        $this->pterodactyl = $pterodactyl;
        $this->service = $service;
    }

    public function handle(Server $server): void
    {
        $this->pterodactyl->deleteServer($server->panel_id);

        $this->service->terminateAllDeploys($server, 'SERVER_DELETED');

        $server->delete();
    }
}
