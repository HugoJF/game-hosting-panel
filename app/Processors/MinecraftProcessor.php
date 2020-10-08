<?php

namespace App\Processors;

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

    /**
     * @inheritDoc
     */
    public function formToStartupConfig(array $form): ?string
    {
        return null;
    }

    public function reject(array $resourceCost): bool
    {
        return parent::reject($resourceCost);
    }
}
