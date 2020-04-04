<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Server;

class ServerController extends Controller
{
    public function servers()
    {
        $servers = Server::query()->paginate(5);

        return view('admins.servers', compact('servers'));
    }
}
