<?php

namespace App\Processors;

use Illuminate\Validation\Rule;

class MinecraftProcessor extends Processor
{
    public function calculateResourceCost(array $config): array
    {
        return [
            'cpu'       => $config['cpu'],
            'memory'    => $config['memory'],
            'disk'      => $config['disk'],
            'databases' => $config['databases'],
        ];
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
