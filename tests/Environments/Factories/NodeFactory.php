<?php

namespace Tests\Environments\Factories;

use App\Node;

class NodeFactory extends Factory
{
    protected string $for = Node::class;

    protected LocationFactory $location;

    public function __construct(LocationFactory $location)
    {
        $this->location = $location;
    }

    public function preCreate(): void
    {
        $this->setParameter('location_id', $this->location->model()->id);
    }
}
