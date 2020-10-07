<?php

namespace App\Processors;

use Illuminate\Validation\Rule;

class MinecraftProcessor extends Processor
{
    public function __construct()
    {
        $this->parameters = config('processors.minecraft.parameters');
    }

    /**
     * @inheritDoc
     */
    protected function rules(): array
    {
        $memory = array_keys(config('processors.minecraft.parameters.memory.options'));
        $disk = array_keys(config('processors.minecraft.parameters.disk.options'));
        $cpu = array_keys(config('processors.minecraft.parameters.cpu.options'));
        $databases = array_keys(config('processors.minecraft.parameters.databases.options'));

        return [
            'memory'    => ['required', 'numeric', Rule::in($memory)],
            'disk'      => ['required', 'numeric', Rule::in($disk)],
            'cpu'       => ['required', 'numeric', Rule::in($cpu)],
            'databases' => ['required', 'numeric', Rule::in($databases)],
        ];
    }

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
