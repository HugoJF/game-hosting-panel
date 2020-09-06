<?php

namespace Tests\Environments\Factories;

use App\Node;

class NodeFactory extends Factory
{
    protected string $for = Node::class;

    protected LocationFactory $location;

    public function __construct()
    {
        $this->location = new LocationFactory;
    }

    public function preBuild(): void
    {
        $this->location->build();

        $this->parameters['location_id'] = $this->location->model();
    }
}
