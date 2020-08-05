<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Server;

class DeployController extends Controller
{
    public function server(Server $server)
    {
        $deploys = $server->deploys()->paginate(5);

        return view('deploys.index', compact('server', 'deploys'));
    }
}
