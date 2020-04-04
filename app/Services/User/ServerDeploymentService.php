<?php

namespace App\Services\User;

use App\Server;
use HCGCloud\Pterodactyl\Pterodactyl;

class ServerDeploymentService
{
    /**
     * @var Pterodactyl
     */
    protected $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    public function handle(Server $server, array $config)
    {
        $this->createDeployment();
        $this->updateServerConfig();
    }

    protected function createDeployment()
    {

    }

    protected function updateServerConfig()
    {

    }
}
