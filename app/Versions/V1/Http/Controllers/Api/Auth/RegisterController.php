<?php

namespace App\Versions\V1\Http\Controllers\Api\Auth;

use App\Versions\V1\DTO\AdminDto;
use App\Versions\V1\DTO\UserDto;
use App\Versions\V1\Http\Requests\AdminRegisterRequest;
use App\Versions\V1\Http\Requests\UserRegisterRequest;
use App\Versions\V1\Services\UserService;

class RegisterController
{
    public function __construct(
        private UserService $service
    ) {
    }

    public function register(UserRegisterRequest $request)
    {
        $user = $this->service->store(UserDto::fromRequest($request));
        $token = $user->createToken()->plainTextToken;

        $user = $user->getUser();

        return compact('user', 'token');
    }

    public function adminRegister(AdminRegisterRequest $request)
    {
        $user = $this->service->store(UserDto::fromRequest($request));
        $token = $user->createToken()->plainTextToken;

        $user = $user->getUser();

        // some new admin policies or else...
        return compact('user', 'token');
    }
}
