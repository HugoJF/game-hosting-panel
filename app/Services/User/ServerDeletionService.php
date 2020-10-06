<?php

namespace App\Services\User;

use App\Server;
use App\Services\ServerService;
use HCGCloud\Pterodactyl\Exceptions\NotFoundException;
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
        try {
            $this->pterodactyl->deleteServer($server->panel_id);
        } catch (NotFoundException $e) {
            // Do nothing since server is not found
        }

        $this->service->terminateAllDeploys($server, 'SERVER_DELETED');

        $server->delete();
    }
}
