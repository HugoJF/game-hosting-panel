<?php

namespace App\Console\Commands;

use App\Location;
use App\Services\LocationService;
use App\Services\PterodactylApiService;
use HCGCloud\Pterodactyl\Resources\Location as LocationResource;
use Illuminate\Console\Command;

class SyncLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panel:sync-locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronizes locations provided by the panel.';

    /**
     * Execute the console command.
     *
     * @param PterodactylApiService $apiService
     * @param LocationService       $service
     *
     * @return mixed
     */
    public function handle(PterodactylApiService $apiService, LocationService $service)
    {
        $locations = collect($apiService->locations());

        /** @var LocationResource $location */
        foreach ($locations as $location) {
            $instance = $service->firstOrCreate($location->id, [
                'short' => $location->short,
                'long'  => $location->long,
            ]);

            $action = $instance->wasRecentlyCreated ? 'Creating' : 'Synchronizing';
            $this->info("$action location $location->short [$location->id]");
        }

        // TODO: delete missing locations (is this a good idea?)
        $invalid = Location::query()->whereNotIn('id', $locations->pluck('id'));
        foreach ($invalid as $location) {
            $this->error("Found invalid location (present in database but not present in panel): $location->short [$location->id]");
        }
    }
}
