<?php

namespace App\Processors;

use Illuminate\Validation\Rule;

class MinecraftProcessor extends Processor
{
    public function __construct()
    {
        $this->params = config('processors.minecraft.parameters');
    }

    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        $sizes = array_keys(config('processors.minecraft.parameters.size.options'));

        return [
            'size'    => ['required', Rule::in($sizes)],
            'plugins' => 'required|numeric',
            'slots'   => 'required|numeric',
        ];
    }

    public function cost(array $config): array
    {
        $memoryPerPlayer = config('processors.minecraft.memory_per_player');
        $diskPerSize = config('processors.minecraft.disk_per_size');

        $disk = $diskPerSize[ $config['size'] ];

        return array_merge(
            config('processors.minecraft.costs'),
            [
                'cpu'    => 300 + (int) ($config['plugins']) * 50, // TODO: magic variables nop
                'memory' => $memoryPerPlayer * (int) ($config['slots']),
                'disk'   => $disk,
            ],
        );
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
