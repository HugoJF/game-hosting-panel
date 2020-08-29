<?php

namespace App\Console\Commands;

use App\Server;
use App\Services\User\DeployCostService;
use HCGCloud\Pterodactyl\Exceptions\NotFoundException;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Console\Command;

class CheckServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'servers:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var Pterodactyl
     */
    protected Pterodactyl $pterodactyl;

    /**
     * Execute the console command.
     *
     * @param DeployCostService $costService
     *
     * @return mixed
     */
    public function handle(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
        foreach (Server::query()->cursor() as $server) {
            $this->line("Checking server $server->hash");
            $this->checkServer($server);
        }
    }

    protected function checkServer(Server $server)
    {
        try {
            $this->pterodactyl->server($server->panel_id);

            $this->info("Server found.");
        } catch (NotFoundException $e) {
            $this->error("NotFoundException thrown, deleting server.");

            $server->delete();
        }
    }
}
