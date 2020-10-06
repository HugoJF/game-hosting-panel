<?php

namespace App\Services;

use HCGCloud\Pterodactyl\Pterodactyl;
use HCGCloud\Pterodactyl\Resources\Nest;

class PterodactylApiService
{
    protected Pterodactyl $pterodactyl;

    public function __construct(Pterodactyl $pterodactyl)
    {
        $this->pterodactyl = $pterodactyl;
    }

    protected function fetchAll(string $resource, ...$arguments): array
    {
        $aggregate = [];
        $currentPage = 1;

        do {
            $parameters = [...$arguments, $currentPage++];
            $api = $this->pterodactyl->$resource(...$parameters);

            $aggregate = array_merge($aggregate, $api['data']);

            $totalPages = $api['meta']['pagination']['total_pages'];
        } while ($currentPage <= $totalPages);

        return $aggregate;
    }

    public function users(): array
    {
        return $this->fetchAll('users');
    }

    /**
     * Paginates the entire /locations endpoint to fetch all locations
     *
     * @return array
     */
    public function locations(): array
    {
        return $this->fetchAll('locations');
    }

    public function nodes(): array
    {
        return $this->fetchAll('nodes');
    }

    public function nests(): array
    {
        return $this->fetchAll('nests');
    }

    public function allocations(int $nodeId): array
    {
        return $this->fetchAll('allocations', $nodeId);
    }

    public function eggs(): array
    {
        $nests = collect($this->nests());

        $aggregate = [];

        /** @var Nest $nest */
        foreach ($nests as $nest) {
            $eggs = $this->pterodactyl->eggs($nest->id);
            $aggregate = array_merge($aggregate, $eggs);
        }

        return $aggregate;
    }
}
