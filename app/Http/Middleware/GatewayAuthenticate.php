<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class GatewayAuthenticate
{
    public function handle($request, Closure $next)
    {
        // Retrieve the gateway secret from environment variables.
        $gatewaySecret = env('GATEWAY_SECRET');

        // If no secret is configured, return a 500 error.
        if (!$gatewaySecret) {
            return response()->json([
                'error' => 'Gateway secret not configured',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Compare the Authorization header to the configured gateway secret.
        if ($request->header('Authorization') !== $gatewaySecret) {
            return response()->json([
                'error' => 'Unauthorized',
                'code' => Response::HTTP_UNAUTHORIZED,
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}