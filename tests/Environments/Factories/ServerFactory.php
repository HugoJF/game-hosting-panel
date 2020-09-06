<?php

namespace Tests\Environments\Factories;

use App\Server;

class ServerFactory extends Factory
{
    protected string $for = Server::class;

    public GameFactory $game;
    public NodeFactory $node;
    public UserFactory $user;

    public function __construct()
    {
        $this->game = new GameFactory;
        $this->node = new NodeFactory;
        $this->user = new UserFactory;
    }

    public function preBuild(): void
    {
        $this->game->build();
        $this->node->build();
        $this->user->build();

        $this->parameters['game_id'] = $this->game->model()->id;
        $this->parameters['node_id'] = $this->node->model()->id;
        $this->parameters['user_id'] = $this->user->model()->id;
    }
}
