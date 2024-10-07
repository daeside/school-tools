<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    /*protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('custom.login');
        }
        return null;
    }*/

    /*protected function unauthenticated($request, array $guards)
    {
        return response()->json([
            'error' => 'Unauthenticated'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->guest()) {
            return $this->unauthenticated($request, $guards);
        }

        return $next($request);
    }*/
}
