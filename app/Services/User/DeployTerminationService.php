<?php

namespace App\Services\User;

use App\Deploy;
use App\Server;

class DeployTerminationService
{
    /**
     * @var ServerTerminationService
     */
    protected $serverTermination;

    public function __construct(ServerTerminationService $terminationService)
    {
        $this->serverTermination = $terminationService;
    }

    public function handle(Server $server, string $reason, bool $forced = false)
    {
        /** @var Deploy $deploy */
        $deploy = $server->getDeploy();

        if (!$deploy->termination_requested_at) {
            $deploy->termination_reason = $reason;
            $deploy->termination_requested_at = now();
        }

        if ($forced) {
            $this->serverTermination->handle($server);
        }

        $deploy->save();
    }
}
