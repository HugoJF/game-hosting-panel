<?php

namespace Tests\Environments\Factories;

use App\Game;

class GameFactory extends Factory
{
    protected Game $game;

    public function build()
    {
        return ($this->game = factory(Game::class)->create());
    }

    public function model()
    {
        return $this->game;
    }
}
