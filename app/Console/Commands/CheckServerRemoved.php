<?php

namespace App\Console\Commands;

use App\Classes\PterodactylApi;
use App\Server;
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

    /**
     * Execute the console command.
     *
     * @param PterodactylApi $pterodactyl
     *
     * @return mixed
     */
    public function handle(Pterodactyl $pterodactyl)
    {
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

    protected function remove(Server $server)
    {
        $this->_info("Server $server->id [PID: $server->panel_id] triggered NotFoundException, marking as removed");
        $server->delete();
    }

    protected function _info($message)
    {
        $this->info($message);
        info($message);
    }
}
