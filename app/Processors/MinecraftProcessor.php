<?php

namespace App\Processors;

class MinecraftProcessor extends Processor
{
    public function __construct()
    {
        $this->params = config('processors.minecraft.parameters');
    }

    // TODO: somehow validate this shit
    public function cost(array $cost): array
    {
        $memoryPerPlayer = config('processors.minecraft.memory_per_player');
        $diskPerSize = config('processors.minecraft.disk_per_size');

        $disk = $diskPerSize[ $cost['size'] ?? 'small' ];

        return array_merge(
            config('processors.minecraft.costs'),
            [
                'cpu'    => 300 + (int) $cost['plugins'] * 50, // TODO: magic variables nop
                'memory' => $memoryPerPlayer * (int) $cost['slots'],
                'disk'   => $disk,
            ],
        );
    }

    protected function reject($cost): bool
    {
        // TODO: this should come from node
        return $cost['cpu'] > 2400;
    }
}
