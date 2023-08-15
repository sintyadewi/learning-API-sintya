<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearerToken = Auth::user()->currentAccessToken();
        $userToFind = $request->route()->parameter('user');
        $isTokenValid = $userToFind->tokens()->find($bearerToken)->isNotEmpty();

        if ($isTokenValid) {
            return $next($request);
        }

        return error_response_handling(401);
    }
}
