<?php

namespace Tests\Environments;

use Closure;
use Exception;
use ReflectionClass;
use ReflectionFunction;
use Tests\Environments\Factories\Factory;

abstract class Environment
{
    protected array $dependencies = [];

    public function registerFactory(string $dependency, bool $entryPoints = false): void
    {
        $reflection = new ReflectionClass($dependency);

        $arguments = [];
        $constructor = $reflection->getConstructor();

        if ($constructor === null) {
            $parameters = [];
        } else {
            $parameters = $constructor->getParameters();
        }

        foreach ($parameters as $parameter) {
            $environmentClass = static::class;
            $dependencyClass = $parameter->getClass()->name;
            $instance = $this->dependency($dependencyClass);

            if ($instance === null) {
                throw new Exception("Could not find factory dependency \"$dependencyClass\" in $environmentClass environment");
            }

            $arguments[] = $instance;
        }

        $this->dependencies[ $dependency ] = new $dependency(...$arguments);
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

    public function dependency(string $dependency)
    {
        return $this->dependencies[ $dependency ] ?? null;
    }

    abstract public function resolveDependencies(): void;
}
