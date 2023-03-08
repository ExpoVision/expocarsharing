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
            return new AuthenticationException();
        }

        if ($requestUser->role === User::ROLE_USER) {
            return new AuthenticationException(__('auth.permission_denied'));
        }

        return $next($request);
    }
}
