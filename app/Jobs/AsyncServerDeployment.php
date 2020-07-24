<?php

namespace App\Jobs;

use App\Exceptions\ServerNotInstalledException;
use App\Server;
use App\Services\ServerService;
use App\Services\User\ServerDeploymentService;
use DateTime;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AsyncServerDeployment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Pterodactyl
     */
    private $pterodactyl;

    /**
     * Server model to be deployed
     *
     * @var Server
     */
    protected $server;

    /**
     * Config used in server deployment
     *
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $billingPeriod;

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
     * @param string $billingPeriod
     * @param array  $config
     */
    public function __construct(Server $server, string $billingPeriod, array $config)
    {
        $this->server = $server;
        $this->billingPeriod = $billingPeriod;
        $this->config = $config;
    }

    /**
     * Execute the job.
     *
     * @param Pterodactyl             $pterodactyl
     * @param ServerService           $serverService
     * @param ServerDeploymentService $deploymentService
     *
     * @return void
     * @throws ServerNotInstalledException
     * @throws \Throwable
     */
    public function handle(
        Pterodactyl $pterodactyl,
        ServerService $serverService,
        ServerDeploymentService $deploymentService
    ): void
    {
        $this->pterodactyl = $pterodactyl;

        if (!$serverService->isInstalled($this->server)) {
            throw new ServerNotInstalledException;
        }

        $deploymentService->handle($this->server, $this->billingPeriod, $this->config);
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return DateTime
     */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(5);
    }
}
