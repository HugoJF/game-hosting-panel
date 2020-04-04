<?php

namespace App\Services\User;

use App\Game;
use App\Node;
use App\Server;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;

class ServerCreationService
{
    /** @var Pterodactyl */
    protected $pterodactyl;

    /** @var DeploymentConfigService */
    protected $configService;

    public function __construct(Pterodactyl $pterodactyl, DeploymentConfigService $configService)
    {
        $this->pterodactyl = $pterodactyl;
        $this->configService = $configService;
    }

    public function handle(User $user, Game $game, Node $node, array $data)
    {
        // Register server on database
        $server = $this->preCreateServerModel($node, $game, $data);

        // Generate config
        $config = $this->configService->handle($user, $node, $game, $data);

        // Create server on panel
        $resource = $this->pterodactyl->createServer($config);

        // Attach panel_id to server
        $this->attachPanelId($server, $resource->id);

        return $server;
    }

    protected function preCreateServerModel(Node $node, Game $game, array $config)
    {
        Server::unguard();
        $server = Server::create([
            'name'    => $config['name'],
            'user_id' => auth()->id(),
            'game_id' => $game->id,
            'node_id' => $node->id,
        ]);
        Server::reguard();

        return $server;
    }

    protected function attachPanelId(Server $server, int $id)
    {
        $server->panel_id = $id;
        $server->save();
    }
}
