<?php

namespace App\Console\Commands;

use App\Classes\PterodactylApi;
use App\Server;
use App\Services\User\ServerDeletionService;
use HCGCloud\Pterodactyl\Exceptions\NotFoundException;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Console\Command;

class CheckServerRemoved extends Command
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

    protected ServerDeletionService $serverDeletion;

    /**
     * Execute the console command.
     *
     * @param ServerDeletionService $deletionService
     * @param Pterodactyl           $pterodactyl
     *
     * @return mixed
     */
    public function handle(ServerDeletionService $deletionService, Pterodactyl $pterodactyl)
    {
        $this->serverDeletion = $deletionService;

        foreach (Server::cursor() as $server) {
            if (!$server->panel_id && $server->created_at->diffInHours() > 1) {
                $this->remove($server);
            }

            try {
                $pterodactyl->server($server->panel_id);
            } catch (NotFoundException $e) {
                $this->remove($server);
            }

            $this->_info("Server $server->id was found!");
        }
    }

    protected function remove(Server $server): void
    {
        $this->_info("Server $server->id [PID: $server->panel_id] triggered NotFoundException, marking as removed");
        $this->serverDeletion->handle($server);
    }

    protected function _info($message): void
    {
        $this->info($message);
        info($message);
    }
}
