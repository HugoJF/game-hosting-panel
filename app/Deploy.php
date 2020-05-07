<?php

namespace App;

use App\Services\User\DeployCostService;
use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Deploy extends Model
{
    use Uuids;

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

    public function billablePeriod()
    {
        /** @var DeployCostService $service */
        $service = app(DeployCostService::class);

        return $service->getBillablePeriod($this);
    }
}
