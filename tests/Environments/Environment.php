<?php

namespace Tests\Environments;

use Tests\Environments\Factories\Factory;

abstract class Environment
{
    protected array $dependencies = [];

    public function registerFactory(string $dependency): void
    {
        $this->dependencies[ $dependency ] = app($dependency);
    }

    public function factory(string $dependency)
    {
        return $this->dependencies[ $dependency ];
    }

    public function build(): void
    {
        /** @var Factory $dependency */
        foreach ($this->dependencies as $dependency) {
            $dependency->build();
        }
    }
}
