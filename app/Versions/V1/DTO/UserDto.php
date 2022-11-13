<?php

namespace App\Versions\V1\DTO;

use App\Models\User;
use App\Versions\V1\Http\Requests\UserRegisterRequest;

class UserDto extends UserDtoAbstract
{
    /**
     * @param UserRegisterRequest $request
     *
     * @return static
     */
    public static function fromRequest($request)
    {
        return new self($request->validated() + [
            'role' => User::ROLE_USER
        ]);
    }
}
