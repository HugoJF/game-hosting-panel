<?php

namespace App\Services\User;

use App\Classes\PterodactylClient;
use App\Deploy;
use App\Server;
use App\Services\ServerService;
use Exception;
use HCGCloud\Pterodactyl\Exceptions\NotFoundException;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Resource;

class ServerTerminationService
{
    protected Pterodactyl $pterodactyl;
    protected PterodactylClient $pterodactylClient;
    protected ServerService $serverService;

    public function __construct(
        Pterodactyl $pterodactyl,
        PterodactylClient $pterodactylClient,
        ServerService $serverService
    )
    {
        $this->pterodactyl = $pterodactyl;
        $this->pterodactylClient = $pterodactylClient;
        $this->serverService = $serverService;
    }

    /**
     * @param Server $server
     *
     * @return bool
     * @throws Exception
     */
    public function handle(Server $server): bool
    {
        $appServer = null;

        try {
            $appServer = $this->shutdownServer($server);
        } catch (NotFoundException $e) {
            report($e);
            info("Server $server->id ($server->name) raised NotFoundException. Treating it as deleted.");
        }

        /** @var Deploy $deploy */
        $deploy = $this->serverService->getCurrentDeploy($server);

        // TODO: what to do if deploy is null?

        $deploy->terminated_at = now();
        $deploy->save();

        return $appServer instanceof Resource;
    }

    /**
     * @param Server $server
     *
     * @return \HCGCloud\Pterodactyl\Resources\Server
     */
    protected function shutdownServer(Server $server): \HCGCloud\Pterodactyl\Resources\Server
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

        $clientServer = $this->pterodactylClient->getServer($appServer->identifier);

        $clientServer->power('kill');

        return $appServer;
    }
}
