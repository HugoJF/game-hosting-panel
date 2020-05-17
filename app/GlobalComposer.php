<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\View\View;

class GlobalComposer
{
    public function compose(View $view)
    {
        if (!auth()->check()) {
            return;
        }

        /** @var User $user */
        $user = auth()->user();

        /** @var Collection $servers */
        $servers = cache()->remember("$user->id.servers", 300, function () {
            return auth()->user()->servers()->with(['deploys'])->get();
        });

        $online = cache()->remember("$user->id.online-servers", 300, function () use ($servers) {
            return $servers->filter(function ($server) {
                return $server->getDeploy();
            });
        });

        $view->with('totalServers', $servers->count());
        $view->with('onlineServers', $online);
    }
}
