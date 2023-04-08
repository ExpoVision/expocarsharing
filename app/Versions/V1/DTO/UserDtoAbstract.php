<?php

namespace App\Versions\V1\DTO;

use App\Caster\HashMakeCaster;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

abstract class UserDtoAbstract extends DataTransferObject
{
    public ?string $name;
    public ?string $email;
    #[CastWith(HashMakeCaster::class)]
    public ?string $password;
    public ?string $role;

    /**
     * @param Illuminate\Http\Request $request
     *
     * @return static
     */
    public static function fromRequest($request)
    {
        return new self($request->all());
    }
}
