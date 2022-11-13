<?php

namespace App\Versions\V1\DTO;

use App\Caster\HashMakeCaster;
use App\Models\User;
use App\Versions\V1\Http\Requests\AdminRegisterRequest;
use Spatie\DataTransferObject\Attributes\CastWith;

class AdminDto extends UserDtoAbstract
{
    public string $name;
    public string $email;
    #[CastWith(HashMakeCaster::class)]
    public string $password;
    public string $role;

    /**
     * @param AdminRegisterRequest $request
     *
     * @return static
     */
    public static function fromRequest($request)
    {
        return new self($request->validated() + [
            'role' => User::ROLE_ADMIN
        ]);
    }
}
