<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 7/22/2019
 * Time: 2:30 AM
 */

namespace App\Services;

use App\Game;
use App\Processors\Processor;

class GameService
{
    /**
     * Wraps firstOrNew in order to better control which parameters are used to first the existing model.
     *
     * @param int   $id
     * @param array $data
     *
     * @return Game
     */
    public function firstOrCreate(int $id, array $data): Game
    {
        return Game::firstOrCreate(compact('id'), $data);
    }

    public function getProcessor(Game $game): ?Processor
    {
        $stub = $game->stub;

        $handler = config("processors.$stub.handler");

        if (!class_exists($handler)) {
            return null;
        }

        return app($handler);
    }
}
