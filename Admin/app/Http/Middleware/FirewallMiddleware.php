<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\Firewall;

class FirewallMiddleware
{
    public function handle($request, Closure $next)
    {
        if ((new Firewall(config('firewall.whitelist')))->isAllowed($request->ip()) == false) {
            abort(403);
        }

        return $next($request);
    }
}
