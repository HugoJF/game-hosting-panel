<?php

namespace App\Processors;

use App\Exceptions\MissingTickrateCpuCost;

class MinecraftProcessor extends Processor
{
    public function __construct()
    {
        $this->params = config('processors.minecraft.parameters');
    }

    public function cost($parameters): array
    {
        $memoryPerPlayer = config('processors.minecraft.memory_per_player');
        $diskPerSize = config('processors.minecraft.disk_per_size');

        $disk = $diskPerSize[$parameters['size']];

        return array_merge(config('processors.minecraft.costs'), [
            'cpu' => 600 + (int) $parameters['plugins'] * 50,
            'memory' => $memoryPerPlayer * (int) $parameters['slots'],
            'disk' => $disk,
        ]);
    }

    function reject($cost): bool
    {
        // TODO: this should come from node
        return $cost['cpu'] > 2400;
    }
}
