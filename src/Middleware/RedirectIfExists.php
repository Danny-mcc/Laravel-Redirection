<?php

namespace Dannymcc\Redirection\Middleware;

use Closure;
use Dannymcc\Redirection\Redirector;

class RedirectIfExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $redirect = app(Redirector::class)->redirectFor($request);

        return $redirect ?? $next($request);
    }
}
