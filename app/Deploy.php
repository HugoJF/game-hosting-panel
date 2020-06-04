<?php

namespace App;

use App\Services\User\DeployCostService;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Deploy extends Model implements Searchable
{
    use Uuids;

    public $incrementing = false;

    protected $dates = ['termination_requested_at', 'terminated_at'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function getConfigAttribute()
    {
        return [
            'cpu'       => $this->cpu,
            'memory'    => $this->memory,
            'disk'      => $this->disk,
            'databases' => $this->databases,
        ];
    }

    public function getNextBillablePeriod()
    {
        $service = app(DeployCostService::class);

        return $service->getNextBillablePeriod($this);
    }

    public function billablePeriod()
    {
        /** @var DeployCostService $service */
        $service = app(DeployCostService::class);

        return $service->getBillablePeriod($this);
    }

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->id,
            route('servers.show', $this->server_id)
        );
    }
}
