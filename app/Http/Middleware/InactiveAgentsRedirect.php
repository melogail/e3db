<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

class InactiveAgentsRedirect
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
        //dd(Auth::check() && Auth::user()->active == 1 && $request->route()->getName() == 'inactive.agent');
        if (Auth::check() && Auth::user()->active == null && $request->route()->getName() !== 'inactive.agent') {
            return redirect(route('inactive.agent'));

        } elseif (Auth::check() && Auth::user()->active == 1 && $request->route()->getName() == 'inactive.agent') {
            return redirect(route('frontend.home'));

        }

        return $next($request);
    }
}
