<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\View\View;

class GlobalComposer
{
    const CACHE_TIME = 1;

    public function compose(View $view)
    {
        if (!auth()->check()) {
            return;
        }

        /** @var User $user */
        $user = auth()->user();

        /** @var Collection $servers */
        $servers = cache()->remember("$user->id.servers", self::CACHE_TIME,
            fn() => auth()->user()->servers()->with(['deploys'])->get()
        );

        $filter = fn($server) => $server->getDeploy();

        $online = cache()->remember("$user->id.online-servers", self::CACHE_TIME,
            fn() => $servers->filter($filter)
        );

        $announcements = cache()->remember('announcements', self::CACHE_TIME,
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
