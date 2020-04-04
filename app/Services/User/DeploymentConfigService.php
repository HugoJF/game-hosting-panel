<?php

namespace App\Services\User;

use App\Game;
use App\Node;
use App\User;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Allocation;
use HCGCloud\Pterodactyl\Resources\Egg;

class DeploymentConfigService
{
    /** @var Pterodactyl */
    protected $pterodactyl;

    /** @var AllocationSelectionService */
    protected $allocationService;

    public function __construct(Pterodactyl $pterodactyl, AllocationSelectionService $allocationService)
    {
        $this->pterodactyl = $pterodactyl;
        $this->allocationService = $allocationService;
    }

    public function handle(User $user, Node $node, Game $game, array $config)
    {
        $allocation = $this->allocationService->handle($node);

        $defaults = $this->getDefaultConfig();
        $base = $this->getBaseConfig($game);
        $config = $this->getConfig($user, $node, $allocation, $config);

        return array_merge_recursive($defaults, $base, $config);
    }

    protected function getDefaultConfig()
    {
        return config('pterodactyl.server-creation-defaults');
    }

    protected function getConfig(User $user, Node $node, Allocation $allocation, array $config)
    {
        return [
            'name'                => $config['name'],
            'user'                => $user->panel_id,
            'node_id'             => $node->id,
            'start_on_completion' => false,
            // This should be based on form data, since it needs to have enough space to install the game.
            'limits'              => [
                'disk' => $config['storage'] * 1000, // MB to GB
            ],
            'allocation'          => [
                'default' => $allocation->id,
            ],
        ];
    }

    protected function getBaseConfig(Game $game)
    {
        $egg = $this->pterodactyl->egg($game->nest_id, $game->id, ['variables']);

        $properties = $this->getProperties($egg);
        $environment = $this->getEnvironment($egg);

        return array_merge($properties, $environment);
    }

    protected function getProperties(Egg $egg)
    {
        return [
            'egg'          => $egg->id,
            'docker_image' => $egg->dockerImage,
            'startup'      => $egg->startup,
        ];
    }

    protected function getEnvironment(Egg $egg)
    {
        $env = collect($egg->relationships['variables'])->mapWithKeys(function ($v) {
            return [$v['env_variable'] => $v['default_value']];
        })->toArray();

        return ['environment' => $env];
    }
}
