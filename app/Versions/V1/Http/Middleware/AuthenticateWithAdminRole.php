<?php

namespace App\Versions\V1\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthenticateWithAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $requestUser = $request->user();

        if (!$requestUser) {
            return response(__('auth.failed'), 401);
        }

        if ($requestUser->role === User::ROLE_USER) {
            return response(__('auth.deny'), 403);
        }

        return $next($request);
    }
}
