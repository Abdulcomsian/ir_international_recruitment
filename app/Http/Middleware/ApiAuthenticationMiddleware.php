<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Attempt to authenticate the user via the token
        if (!Auth::guard('api')->user()) {
            return response()->json(['success' => false, 'msg' => 'Unauthorized. Token is invalid or expired.', 'status' => 401], 401);
        }

        return $next($request);
    }
}
