<?php

namespace Tests\Environments\Factories;

abstract class Factory
{
    protected array $parameters = [];

    abstract public function model();

    abstract public function build();
}
