<?php

namespace Tests\Environments\Factories;

use App\Node;

class NodeFactory extends Factory
{
    protected Node $node;

    protected LocationFactory $location;

    public function __construct()
    {
        $this->location = new LocationFactory;
    }

    public function model(): Node
    {
        return $this->node;
    }

    public function build()
    {
        $this->location->build();

        $this->parameters['location_id'] = $this->location->model();

        return ($this->node = factory(Node::class)->create($this->parameters));
    }
}
