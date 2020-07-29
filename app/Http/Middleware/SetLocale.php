<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetLocale
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
        if (auth()->check() && ($locale = auth()->user()->locale)) {
            app()->setLocale($locale);

            return redirect('home');
        }

        return $next($request);
    }
}
