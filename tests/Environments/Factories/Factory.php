<?php

namespace Tests\Environments\Factories;

use App\Node;
use Exception;

abstract class Factory
{
    protected string $for;

    protected array $parameters = [];

    /** @var mixed */
    protected $model;

    public function model()
    {
        return $this->model;
    }

    public function create()
    {
        $this->preCreate();
        $this->model = factory($this->for)->create($this->parameters);
        $this->postCreate();
    }

    public function setParameter(string $name, $value): Factory
    {
        $this->parameters[$name] = $value;

        return $this;
    }

    public function preCreate(): void
    {
        //
    }

    public function postCreate(): void
    {
        //
    }
}
