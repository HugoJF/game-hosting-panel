<?php

namespace Tests\Environments;

use Closure;
use Exception;
use ReflectionFunction;
use Tests\Environments\Factories\Factory;

abstract class Environment
{
    protected array $dependencies = [];

    public function registerFactory(string $dependency): void
    {
        $this->dependencies[ $dependency ] = app($dependency);
    }

    public function with(Closure $call): Environment
    {
        $reflection = new ReflectionFunction($call);

        if ($reflection->getNumberOfParameters() > 1) {
            throw new Exception('Too many parameters for chainable');
        }

        $parameter = $reflection->getParameters()[0];

        $call($this->dependency($parameter->getClass()->name));

        return $this;
    }

    public function get(Closure $call)
    {
        $reflection = new ReflectionFunction($call);

        if ($reflection->getNumberOfParameters() > 1) {
            throw new Exception('Too many parameters for chainable');
        }

        $parameter = $reflection->getParameters()[0];

        return $call($this->dependency($parameter->getClass()->name));
    }

    public function dependency(string $dependency)
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
