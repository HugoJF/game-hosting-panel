<?php

namespace App\Services\User;

use App\Game;
use App\Jobs\ServerCreationMonitor;
use App\Node;
use App\Server;
use App\User;
use Exception;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;
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

    /**
     * @var AllocationSelectionService
     */
    protected $allocationService;

    public function __construct(
        Pterodactyl $pterodactyl,
        ServerCreationConfigService $configService,
        AllocationSelectionService $allocationService
    )
    {
        $this->pterodactyl = $pterodactyl;
        $this->configService = $configService;
        $this->allocationService = $allocationService;
    }

    public function handle(User $user, Game $game, Node $node, array $data): Server
    {
        // Find an allocation
        $allocation = $this->allocationService->handle($node);

        // Register server on database
        $server = $this->preCreateServerModel($user, $node, $game, $allocation, $data);

        // Generate config
        $config = $this->configService->handle($user, $node, $game, $server, $allocation, $data);

        // Create server on panel
        $resource = $this->pterodactyl->createServer($config);

        // TODO: temporary check since we disabled non-useful validation messages from panel.
        if (!($resource instanceof \HCGCloud\Pterodactyl\Resources\Server)) {
            logger()->error($resource);
            throw new Exception('Pterodactyl API returned non-resource');
        }

        // Attach panel_id to server
        $this->attachPanelId($server, $resource->id);

        // Dispatch job that will monitor when server is installed
        $this->dispatchMonitoringJob($server);

        return $server;
    }

    protected function preCreateServerModel(User $user, Node $node, Game $game, Allocation $allocation, array $config)
    {
        $server = new Server;

        $fromDefaults = ['io' => 500];
        $fromForm = collect($config)->only(['cpu', 'memory', 'disk', 'databases'])->toArray();
        $fromRelationships = [
            'name'    => Str::random(),
            'ip'      => "$allocation->ip:$allocation->port",
            'user_id' => $user->id,
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
