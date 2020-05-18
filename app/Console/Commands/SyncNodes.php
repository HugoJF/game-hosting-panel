<?php

namespace App\Console\Commands;

use App\Node;
use App\Services\NodeService;
use App\Services\PterodactylApiService;
use HCGCloud\Pterodactyl\Resources\Node as NodeResource;
use Illuminate\Console\Command;

class SyncNodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'panel:sync-nodes';

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
     * @param NodeService           $service
     *
     * @return mixed
     */
    public function handle(PterodactylApiService $apiService, NodeService $service)
    {
        $nodes = collect($apiService->nodes());

        /** @var NodeResource $node */
        foreach ($nodes as $node) {
            $instance = $service->firstOrCreate($node->id, [
                'name'        => $node->name,
                'description' => $node->description,
                'location_id' => $node->locationId,
            ]);

            $action = $instance->wasRecentlyCreated ? 'Creating' : 'Synchronizing';
            $this->info("$action node $node->name [$node->id]");
        }

        // TODO: delete missing locations (is this a good idea?)
        $invalid = Node::query()->whereNotIn('id', $nodes->pluck('id'));
        foreach ($invalid as $node) {
            $this->error("Found invalid node (present in database but not present in panel): $node->name [$node->id]");
        }
    }
}
