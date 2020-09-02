<?php

namespace App\Http\Middleware;

use Closure;

class CheckReleased
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next)
    {
        if (config('ghp.released', false)) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
