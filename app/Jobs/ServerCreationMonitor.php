<?php

namespace App\Jobs;

use App\Exceptions\ServerNotInstalledException;
use App\Server;
use App\Services\ServerService;
use DateTime;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ServerCreationMonitor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var ServerService
     */
    protected $service;

    /**
     * @var Server
     */
    protected $server;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $retryAfter = 30;
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 50;

    /**
     * Create a new job instance.
     *
     * @param Server $server
     */
    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    /**
     * Execute the job.
     *
     * @param ServerService $service
     *
     * @return void
     * @throws ServerNotInstalledException
     */
    public function handle(ServerService $service)
    {
        if (!$service->isInstalled($this->server)) {
            throw new ServerNotInstalledException;
        }

        $this->server->installed_at = now();
        $this->server->save();
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return DateTime
     */
    public function retryUntil()
    {
        return now()->addMinutes(10);
    }
}
