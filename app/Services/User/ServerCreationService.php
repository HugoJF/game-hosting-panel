<?php

namespace App\Services\User;

use App\Game;
use App\Jobs\ServerCreationMonitor;
use App\Node;
use App\Server;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use Illuminate\Support\Str;

class ServerCreationService
{
    /**
     * @var Pterodactyl
     */
    protected $pterodactyl;

    /**
     * @var ServerCreationConfigService
     */
    protected $configService;

    public function __construct(Pterodactyl $pterodactyl, ServerCreationConfigService $configService)
    {
        $this->pterodactyl = $pterodactyl;
        $this->configService = $configService;
    }

    public function handle(User $user, Game $game, Node $node, array $data)
    {
        // Register server on database
        $server = $this->preCreateServerModel($node, $game, $data);

        // Generate config
        $config = $this->configService->handle($user, $node, $game, $server, $data);

        // Create server on panel
        $resource = $this->pterodactyl->createServer($config);

        // Attach panel_id to server
        $this->attachPanelId($server, $resource->id);

        // Dispatch job that will monitor when server is installed
        $this->dispatchMonitoringJob($server);

        return $server;
    }

    protected function preCreateServerModel(Node $node, Game $game, array $config)
    {
        $server = new Server;

        $fromDefaults = ['io' => 500];
        $fromForm = collect($config)->only(['cpu', 'memory', 'disk', 'databases'])->toArray();
        $fromRelationships = [
            'name'    => Str::random(),
            'user_id' => auth()->id(),
            'game_id' => $game->id,
            'node_id' => $node->id,
        ];
        $server->forceFill(array_merge($fromDefaults, $fromForm, $fromRelationships))->save();

        return $server;
    }

    protected function attachPanelId(Server $server, int $id)
    {
        $server->panel_id = $id;
        $server->save();
    }

    protected function dispatchMonitoringJob(Server $server)
    {
        dispatch(new ServerCreationMonitor($server));
    }
}
