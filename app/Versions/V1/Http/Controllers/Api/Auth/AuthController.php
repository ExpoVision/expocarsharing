<?php

namespace App\Versions\V1\Http\Controllers\Api\Auth;

use App\Versions\V1\Http\Requests\LoginRequest;
use App\Versions\V1\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            /** @var \App\Models\User $user */
            $user = auth()->user();

            /** @var \App\Versions\V1\Services\UserService $token */
            $token = app(UserService::class, compact('user'));
            $token = $token->createToken()->plainTextToken;

            return response(compact('user', 'token'));
        }

        return response('', 403);
    }

    public function refresh(Request $request)
    {
        // refresh token
    }

    public function logout(Request $request)
    {
        Auth::logout();
    }
}
