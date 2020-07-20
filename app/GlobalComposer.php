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
        $servers = cache()->remember("$user->id.servers", 300,
            fn() => auth()->user()->servers()->with(['deploys'])->get()
        );

        $filter = fn($server) => $server->getDeploy();

        $online = cache()->remember("$user->id.online-servers", 300,
            fn() => $servers->filter($filter)
        );

        $announcements = cache()->remember('announcements', 300,
            fn() => Announcement::query()
                                ->latest()
                                ->where('visible', true)
                                ->get()
        );

        $view->with('globalAnnouncements', $announcements);
        $view->with('totalServers', $servers->count());
        $view->with('onlineServers', $online);
    }
}
