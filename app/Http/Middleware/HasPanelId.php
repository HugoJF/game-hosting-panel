<?php

namespace App\Http\Middleware;

use App\Events\UserMissingPanelRegistration;
use Closure;
use Illuminate\Http\Request;

class HasPanelId
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!($user = auth()->user())->panel_id) {
            event(new UserMissingPanelRegistration($user));

            flash()->error('You account is not registered on our panel yet. Please wait a few minutes and try again.');

            return redirect()->route('home');
        }

        return $next($request);
    }
}
