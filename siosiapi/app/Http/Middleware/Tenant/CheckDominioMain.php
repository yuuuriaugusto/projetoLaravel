<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class CheckDominioMain
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
        if (request()->getHost() != config('tenant.dominio.main')) {
            abort(401);
        }
        return $next($request);
    }
}
