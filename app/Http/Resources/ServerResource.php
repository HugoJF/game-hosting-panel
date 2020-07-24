<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $server = parent::toArray($request);

        $links = [
            'links' => [
                'show' => route('servers.show', $this->resource),
            ],
        ];

        return array_merge($server, $links);
    }
}
