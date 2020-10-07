<?php

namespace App\Services\User;

use App\Server;
use App\Services\GameService;
use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Egg;

class ServerStartupConfigService
{
    protected Pterodactyl $pterodactyl;
    protected GameService $gameService;

    public function __construct(Pterodactyl $pterodactyl, GameService $gameService)
    {
        $this->pterodactyl = $pterodactyl;
        $this->gameService = $gameService;
    }

    public function handle(Server $server, array $form): ?array
    {
        $processor = $this->gameService->getProcessor($server->game);

        $startup = $processor->formToStartupConfig($form);

        // Check if game does not update startup config
        if ($startup === null) {
            return null;
        }

        $egg = $this->pterodactyl->egg($server->game->nest_id, $server->game->id, ['variables']);

        return [
            'startup'      => $startup,
            'egg'          => $server->game->id,
            'image'        => $egg->dockerImage,
            'skip_scripts' => false,
            'environment'  => $this->getDefaultEnvironment($egg),
        ];
    }

    protected function getDefaultEnvironment(Egg $egg): array
    {
        return collect($egg->relationships['variables'])->mapWithKeys(fn($v) => [
            $v['env_variable'] => $v['default_value'],
        ])->toArray();
    }
}
