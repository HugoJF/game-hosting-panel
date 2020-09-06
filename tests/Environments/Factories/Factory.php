<?php

namespace Tests\Environments\Factories;

abstract class Factory
{
    protected array $parameters = [];

    protected string $for;

    /** @var mixed */
    protected $model;

    public function model()
    {
        return $this->model;
    }

    public function build()
    {
        $this->preBuild();
        $this->model = factory($this->for)->create($this->parameters);
        $this->postBuild();
    }

    public function preBuild(): void
    {
        //
    }

    public function postBuild(): void
    {
        //
    }
}
