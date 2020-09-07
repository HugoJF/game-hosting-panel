<?php

namespace Tests\Environments;

use App\Game;
use App\Location;
use App\Node;
use Tests\Environments\Factories\GameFactory;
use Tests\Environments\Factories\LocationFactory;
use Tests\Environments\Factories\NodeFactory;

class BaseEnvironment extends Environment
{
    public function __construct()
    {
        $this->registerFactory(GameFactory::class);

        $this->registerFactory(LocationFactory::class);
        $this->registerFactory(NodeFactory::class);
    }

    public function resolveDependencies(): void
    {
        $this->gameFactory()->create();
        $this->locationFactory()->create();
        $this->nodeFactory()->create();
    }

    public function gameFactory(): GameFactory
    {
        return $this->dependency(GameFactory::class);
    }

    public function game(): Game
    {
        return $this->gameFactory()->model();
    }

    public function locationFactory(): LocationFactory
    {
        return $this->dependency(LocationFactory::class);
    }

    public function location(): Location
    {
        return $this->locationFactory()->model();
    }

    public function nodeFactory(): NodeFactory
    {
        return $this->dependency(NodeFactory::class);
    }

    public function node(): Node
    {
        return $this->nodeFactory()->model();
    }
}
