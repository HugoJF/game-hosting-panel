<?php

namespace Tests\Environments\Factories;

use App\Server;

class ServerFactory extends Factory
{
    protected string $for = Server::class;

    public GameFactory $game;
    public NodeFactory $node;
    public UserFactory $user;
    public LocationFactory $location;

    public function __construct(
        GameFactory $game,
        NodeFactory $node,
        UserFactory $user
    ) {
        $this->game = $game;
        $this->node = $node;
        $this->user = $user;

        $this->user->withBalance(9999);
    }

    public function preCreate(): void
    {
        $this->parameters['game_id'] = $this->game->model()->id;
        $this->parameters['node_id'] = $this->node->model()->id;
        $this->parameters['user_id'] = $this->user->model()->id;
    }

    public function postCreate(): void
    {
        $this->game->model()->nodes()->attach($this->node->model());
    }
}
