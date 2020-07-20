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

    protected function fetchAll(string $resource)
    {
        $aggregate = [];
        $currentPage = 1;

        do {
            $api = $this->pterodactyl->$resource($currentPage++);

            $aggregate = array_merge($aggregate, $api['data']);

            $totalPages = $api['meta']['pagination']['total_pages'];
        } while ($currentPage <= $totalPages);

        return $aggregate;
    }

    public function users()
    {
        return $this->fetchAll('users');
    }

    /**
     * Paginates the entire /locations endpoint to fetch all locations
     *
     * @return array
     */
    public function locations()
    {
        return $this->fetchAll('locations');
    }

    public function nodes()
    {
        return $this->fetchAll('nodes');
    }

    public function nests()
    {
        return $this->fetchAll('nests');
    }

    public function eggs()
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
