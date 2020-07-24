<?php

namespace App\Services\User;

use App\Deploy;
use App\Server;
use App\Services\ServerService;

class DeployTerminationService
{
    protected ServerService $serverService;
    protected ServerTerminationService $serverTermination;

    public function __construct(ServerService $serverService, ServerTerminationService $terminationService)
    {
        $this->serverService = $serverService;
        $this->serverTermination = $terminationService;
    }

    public function handle(Server $server, string $reason, bool $forced = false): void
    {
        $deploy = $this->serverService->getCurrentDeploy($server);

        if (!$deploy) {
            return;
        }

        if (!$deploy->termination_requested_at) {
            $deploy->termination_reason = $reason;
            $deploy->termination_requested_at = now();
            $deploy->save();
        }

        if ($forced) {
            $this->serverTermination->handle($server);
        }
    }
}
