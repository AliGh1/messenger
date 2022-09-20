<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLastSeenActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ((! $request->user()) || $this->isNotDirty() )
            return $next($request);

        $request->user()->update([
            'last_seen' => now()
        ]);

        \Session::put('last_seen', now());

        return $next($request);
    }

    private function isNotDirty(): bool
    {
        if (! \Session::has('last_seen'))
            \Session::put('last_seen', \Auth::user()->last_seen);

        return now()->diffInMinutes(\Session::get('last_seen')) < 1;
    }
}
