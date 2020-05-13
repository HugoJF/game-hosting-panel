<?php

namespace App\Http\Controllers\Api;

use App\Game;
use App\Http\Controllers\Controller;
use App\Location;
use App\Node;
use App\Server;
use App\Services\User\DeployCostService;
use App\Services\User\NodeSelectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ConfigurerController extends Controller
{
    public function games()
    {
        return Game::all();
    }
}
