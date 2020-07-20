<?php

namespace App\Services\User;

use App\Game;
use App\Node;
use App\Server;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;
use HCGCloud\Pterodactyl\Resources\Egg;

class ServerCreationConfigService
{
    protected Pterodactyl $pterodactyl;
    protected AllocationSelectionService $allocationService;

    public function __construct(Pterodactyl $pterodactyl, AllocationSelectionService $allocationService)
    {
        $this->pterodactyl = $pterodactyl;
        $this->allocationService = $allocationService;
    }

    public function handle(User $user, Node $node, Game $game, Server $server, Allocation $allocation, array $config)
    {
        $defaults = $this->getDefaultConfig();
        $base = $this->getBaseConfig($game);
        $config = $this->getConfig($user, $node, $allocation, $server, $config);

        return array_merge_recursive($defaults, $base, $config);
    }

    protected function getDefaultConfig()
    {
        return config('pterodactyl.server-creation-defaults');
    }

    protected function getConfig(User $user, Node $node, Allocation $allocation, Server $server, array $config)
    {
        return [
            'name'                => $server->name,
            'user'                => $user->panel_id,
            'node_id'             => $node->id,
            'start_on_completion' => false,
            'allocation'          => [
                'default' => $allocation->id,
            ],
        ];
    }

    protected function getBaseConfig(Game $game)
    {
        $egg = $this->pterodactyl->egg($game->nest_id, $game->id, ['variables']);

        $properties = $this->getImageProperties($egg);
        $environment = $this->getDefaultEnvironment($egg);

        return array_merge($properties, $environment);
    }

    protected function getImageProperties(Egg $egg)
    {
        return [
            'egg'          => $egg->id,
            'docker_image' => $egg->dockerImage,
            'startup'      => $egg->startup,
        ];
    }

    protected function getDefaultEnvironment(Egg $egg)
    {
        $environment = collect($egg->relationships['variables'])->mapWithKeys(fn($v) => [
            $v['env_variable'] => $v['default_value'],
        ])->toArray();

        return ['environment' => $environment];
    }
}
