<?php

namespace App\Console\Commands;

use App\Game;
use App\Services\GameService;
use App\Services\PterodactylApiService;
use HCGCloud\Pterodactyl\Resources\Egg as EggResource;
use Illuminate\Console\Command;

class SyncEggs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panel:sync-eggs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes eggs provided by the panel.';

    /**
     * Execute the console command.
     *
     * @param PterodactylApiService $apiService
     * @param GameService           $service
     *
     * @return void
     */
    public function handle(PterodactylApiService $apiService, GameService $service): void
    {
        $eggs = collect($apiService->eggs());

        /** @var EggResource $egg */
        foreach ($eggs as $egg) {
            $instance = $service->firstOrCreate($egg->id, [
                'name'        => $egg->name,
                'description' => $egg->description,
                'nest_id'     => $egg->nest,
            ]);

            $action = $instance->wasRecentlyCreated ? 'Creating' : 'Synchronizing';
            $this->info("$action game $egg->name [$egg->id]");
        }

        // TODO: delete missing eggs (is this a good idea?)
        $invalid = Game::query()->whereNotIn('id', $eggs->pluck('id'));
        foreach ($invalid as $egg) {
            $this->error("Found invalid game (present in database but not present in panel): $egg->name [$egg->id]");
        }
    }
}
