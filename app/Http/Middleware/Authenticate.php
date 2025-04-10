<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

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
    // Determine the site number based on the request path
    $siteNumber = null;

    if ($request->is('users1/*')) {
        $siteNumber = 1;
    } elseif ($request->is('users2/*')) {
        $siteNumber = 2;
    }

    // Check authentication
    if ($this->auth->guard($guard)->guest()) {
        return response()->json([
            'error' => "Unauthorized",
            'code' => 401,
            'site' => $siteNumber
        ], 401);
    }

    return $next($request);
}

}