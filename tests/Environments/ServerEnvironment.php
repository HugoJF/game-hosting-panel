<?php

namespace Tests\Environments;

use App\Game;
use App\Node;
use App\User;
use Tests\Environments\Factories\GameFactory;
use Tests\Environments\Factories\NodeFactory;
use Tests\Environments\Factories\ServerFactory;
use Tests\Environments\Factories\UserFactory;

class ServerEnvironment extends Environment
{
    protected ServerFactory $server;

    public function __construct()
    {
        $this->registerFactory(ServerFactory::class);
    }

    public function serverFactory(): ServerFactory
    {
        return $this->factory(ServerFactory::class);
    }

    public function userFactory(): UserFactory
    {
        return $this->serverFactory()->user;
    }

    public function user(): User
    {
        return $this->userFactory()->model();
    }

    public function gameFactory(): GameFactory
    {
        return $this->serverFactory()->game;
    }

    public function game(): Game
    {
        return $this->gameFactory()->model();
    }

    public function nodeFactory(): NodeFactory
    {
        return $this->serverFactory()->node;
    }

    public function node(): Node
    {
        return $this->nodeFactory()->model();
    }
}
