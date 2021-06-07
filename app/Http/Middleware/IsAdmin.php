<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        $admin_users = ['admin', 'superuser'];

        if (! in_array(auth()->user()->role, $admin_users)) {
            abort(404);
        } else {
            return $next($request);
        }
    }
}
