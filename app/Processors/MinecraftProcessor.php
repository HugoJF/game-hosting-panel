<?php

namespace App\Processors;

class MinecraftProcessor extends Processor
{
    public function __construct()
    {
        $this->params = config('processors.minecraft.parameters');
    }

    public function cost($cost): array
    {
        $memoryPerPlayer = config('processors.minecraft.memory_per_player');
        $diskPerSize = config('processors.minecraft.disk_per_size');

        $disk = $diskPerSize[ $cost['size'] ];

        return [
            ...config('processors.minecraft.costs'),
            ...[
                'cpu'    => 600 + (int) $cost['plugins'] * 50, // TODO: magic variables nop
                'memory' => $memoryPerPlayer * (int) $cost['slots'],
                'disk'   => $disk,
            ],
        ];
    }

    function reject($cost): bool
    {
        // TODO: this should come from node
        return $cost['cpu'] > 2400;
    }
}
