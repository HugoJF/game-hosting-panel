<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\View\View;

class GlobalComposer
{
    private int $cacheTime = 1;

    public function __construct()
    {
        if (app()->environment('production')) {
            $this->cacheTime = 120;
        }
    }

    public function compose(View $view)
    {
        if (!auth()->check()) {
            return;
        }

        /** @var User $user */
        $user = auth()->user();

        /** @var Collection $servers */
        $servers = cache()->remember("$user->id.servers", $this->cacheTime,
            fn() => auth()->user()->servers()->with(['deploys'])->get()
        );

        $filter = fn($server) => $server->getDeploy();

        $online = cache()->remember("$user->id.online-servers", $this->cacheTime,
            fn() => $servers->filter($filter)
        );

        $announcements = cache()->remember('announcements', $this->cacheTime,
            fn() => Announcement::query()
                                ->latest()
                                ->where('visible', true)
                                ->where('expires_at', '>', now())
                                ->get()
        );

        $view->with('globalAnnouncements', $announcements);
        $view->with('totalServers', $servers->count());
        $view->with('onlineServers', $online);
    }
}
