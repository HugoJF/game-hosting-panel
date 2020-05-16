<?php

namespace App\Http\Middleware;

use Closure;

class HasPanelId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->panel_id) {
            flash()->error('You account is not registered on our panel yet. Please wait a few minutes and try again.');

            return redirect()->route('home');
        }

        return $next($request);
    }
}
