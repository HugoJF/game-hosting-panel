<?php

namespace App\Services\User;

use App\Deploy;
use App\Node;
use App\Server;
use Exception;

class DeployTerminationService
{
    /**
     * @var ServerTerminationService
     */
    protected $terminationService;

    public function __construct(ServerTerminationService $terminationService)
    {
        $this->terminationService = $terminationService;
    }

    public function handle(Server $server, bool $forced = false)
    {
        /** @var Deploy $deploy */
        $deploy = $server->getDeploy();

        if (!$deploy->termination_requested_at) {
            $deploy->termination_requested_at = now();
        }

        if ($forced) {
            $this->terminationService->handle($server);
        }

        $deploy->save();
    }
}
